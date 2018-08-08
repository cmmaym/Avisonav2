<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class CoordinateFilter extends ModelFilter
{
    public function latitud($latitud){
        return $this->where('latitud', 'like', "%$latitud%");
    }
    
    public function longitud($longitud){
        return $this->where('longitud', 'like', "%$longitud%");
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
        return $this->orderBy('latitud', $this->input('dir', 'asc'));
    }
    
    public function sortByLongitud()
    {
        return $this->orderBy('longitud', $this->input('dir', 'asc'));
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}