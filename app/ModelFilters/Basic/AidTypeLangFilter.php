<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class AidTypeLangFilter extends ModelFilter
{
    public function name($name){
        return $this->where('name', 'like', "%$name%");
    }

    public function createdAt($createdAt){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($createdAt, $createdAt));
    }

    public function language($language){
        return $this->related('language', 'code', 'like', "%$language%");
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('id', $this->input('dir', 'asc'));
    }

    public function sortByName(){
        return $this->orderBy('name', $this->input('dir', 'asc'));
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}