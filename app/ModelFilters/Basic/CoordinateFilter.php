<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;
use Illuminate\Support\Facades\DB;

class CoordinateFilter extends ModelFilter
{
    public function latitud($latitude){
        return $this->whereRaw("CONCAT(latitude_degrees, latitude_minutes, latitude_seconds) like ?", array('%'.$latitude.'%'));
    }
    
    public function longitud($longitude){
        return $this->whereRaw("CONCAT(longitude_degrees, longitude_minutes, longitude_seconds) like ?", array('%'.$longitude.'%'));
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

    public function sortByLatitud()
    {
        return $this->orderBy(DB::raw('CONCAT(latitude_degrees, latitude_minutes, latitude_seconds)'), $this->input('dir', 'asc'));
    }
    
    public function sortByLongitud()
    {
        return $this->orderBy(DB::raw('CONCAT(longitude_degrees, longitude_minutes, longitude_seconds)'), $this->input('dir', 'asc'));
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}