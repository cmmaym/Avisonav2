<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class LocationFilter extends ModelFilter
{

    public function name($name){
        return $this->where('name', 'like', "%$name%");
    }

    public function subLocationName($subLocationName){
        return $this->where('sub_location_name', 'like', "%$subLocationName%");
    }

    public function zone($name){
        $this->whereHas('zone.zoneLang', function($query) use ($name){
            $query->where('name', 'like', "%$name%");
        });
    }

    public function createdAt($createdAt){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($createdAt, $createdAt));
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('id', $this->input('dir', 'asc'));
    }

    public function sortByName()
    {
        return $this->orderBy('name', $this->input('dir', 'asc'));
    }

    public function sortBySubName()
    {
        return $this->orderBy('sub_location_name', $this->input('dir', 'asc'));
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }

    public function sortByZoneName(){
        $input = $this->input('dir', 'asc');

        $this->join('zone', 'location.zone_id', '=', 'zone.id')
             ->orderBy('zone.name', $input)
             ->select('location.*');
    }
}