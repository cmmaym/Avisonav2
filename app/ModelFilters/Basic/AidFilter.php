<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class AidFilter extends ModelFilter
{

    public function subName($subName){
        return $this->where('sub_name', 'like', "%$subName%");
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

    public function sortBySubName()
    {
        return $this->orderBy('sub_name', $this->input('dir', 'asc'));
    }

    public function sortByDate()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}