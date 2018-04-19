<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class LightTypeFilter extends ModelFilter
{
    public function class($class){
        return $this->where('class', 'like', "%$class%");
    }

    public function alias($alias){
        return $this->where('alias', 'like', "%$alias%");
    }

    public function description($description){
        return $this->where('description', 'like', "%$description%");
    }

    public function date($date){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($date, $date));
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('id', $this->input('dir', 'asc'));
    }

    public function sortByClass()
    {
        return $this->orderBy('class', $this->input('dir', 'asc'));
    }

    public function sortByAlias()
    {
        return $this->orderBy('alias', $this->input('dir', 'asc'));
    }

    public function sortByDescription()
    {
        return $this->orderBy('description', $this->input('dir', 'asc'));
    }

    public function sortByDate()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}