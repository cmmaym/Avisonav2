<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class AidTypeLangFilter extends ModelFilter
{
    public function name($name){
        return $this->where('name', 'like', "%$name%");
    }

    public function date($date){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($date, $date));
    }

    public function language($language){
        return $this->where('language_id', '=', $language);
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('id', $this->input('dir', 'asc'));
    }

    public function sortByType()
    {
        return $this->orderBy('type', $this->input('dir', 'asc'));
    }

    public function sortByName(){
        return $this->orderBy('name', $this->input('dir', 'asc'));
    }

    public function sortByDate()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}