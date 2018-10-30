<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class ZoneFilter extends ModelFilter
{
    public function name($name){
        return $this->related('zoneLang', 'name', 'like', "%$name%");
    }

    public function alias($alias){
        return $this->related('zoneLang', 'alias', 'like', "%$alias%");
    }

    public function createdAt($createdAt){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($createdAt, $createdAt));
    }

    public function createdBy($createdBy){
        return $this->where('zone.created_by', 'like', "%$createdBy%");
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
        $input = $this->input('dir', 'asc');

        $this->join('zone_lang', 'zone_lang.zone_id', '=', 'zone.id')
             ->groupBy('zone.id')
             ->orderBy('zone_lang.name', $input)
             ->select('zone.*');
    }

    public function sortByAlias()
    {
        $input = $this->input('dir', 'asc');

        $this->join('zone_lang', 'zone_lang.zone_id', '=', 'zone.id')
             ->groupBy('zone.id')
             ->orderBy('zone_lang.alias', $input)
             ->select('zone.*');
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}