<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;
use Illuminate\Support\Facades\DB;

class CoordinateFilter extends ModelFilter
{
    // public function latitud($latitude){
    //     return $this->where('latitude', 'like', '%'.$latitude.'%');
    // }
    
    // public function longitud($longitude){
    //     return $this->where('longitude', 'like', '%'.$longitude.'%');
    // }

    // public function createdAt($createdAt){
    //     return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($createdAt, $createdAt));
    // }

    // public function sort($column)
    // {
    //     if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
    //         return $this->$method();
    //     }

    //     return $this->orderBy('id', $this->input('dir', 'asc'));
    // }

    // public function sortByLatitud()
    // {
    //     return $this->orderBy('latitude', $this->input('dir', 'asc'));
    // }
    
    // public function sortByLongitud()
    // {
    //     return $this->orderBy(longitude, $this->input('dir', 'asc'));
    // }

    // public function sortByCreatedAt()
    // {
    //     return $this->orderBy('coordinate.created_at', $this->input('dir', 'asc'));
    // }
}