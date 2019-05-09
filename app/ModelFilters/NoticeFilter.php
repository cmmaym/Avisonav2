<?php

namespace AvisoNavAPI\ModelFilters;

use EloquentFilter\ModelFilter;

class NoticeFilter extends ModelFilter
{
    public function number($number){
        return $this->where('number', 'like', "%$number%");
    }
    
    public function year($year){
        return $this->where('year', 'like', "%$year%");
    }
    
    public function createdAt($createdAt){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($createdAt, $createdAt));
    }

    public function zone($zone){
        $this->whereHas('location.zone.zoneLang', function($query) use ($zone) {
            $query->where('name', 'like', "%$zone%");
        });
    }

    public function chart($chart){
        $this->whereHas('novelty.chartEdition.chart', function($query) use($chart){
            $query->where('number', $chart);
        });
    }

    public function description($description){
        $this->whereHas('noticeLang', function($query) use ($description){
            $query->where('description', 'like', "%$description%");
        });
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }
        return $this->orderBy('id', $this->input('dir', 'desc'));
    }

    public function sortByNumber()
    {
        return $this->orderBy('number', $this->input('dir', 'asc'));
    }
    
    public function sortByYear()
    {
        return $this->orderBy('year', $this->input('dir', 'asc'));
    }
    
    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
    
    public function sortByZone()
    {
        $input = $this->input('dir', 'asc');

        $this->join('location', 'notice.location_id', '=', 'location.id')
             ->join('zone', 'location.zone_id', '=', 'zone.id')
             ->join('zone_lang', 'zone.id', '=', 'zone_lang.zone_id')
             ->groupBy('notice.number')
             ->orderBy('zone_lang.name', $input)
             ->select('notice.*');
    }
}