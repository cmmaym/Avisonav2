<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class NoticeLangFilter extends ModelFilter
{
    public function description($description)
    {
        return $this->where('description', 'like', "%$description%");
    }
    
    public function createdAt($createdAt)
    {
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($createdAt, $createdAt));
    }

    public function language($language){
        return $this->related('language', 'code', 'like', "%$language%");
    }
    
    public function langName($langName){
        return $this->related('language', 'name', 'like', "%$langName%");
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('id', $this->input('dir', 'desc'));
    }

    public function sortByDescription()
    {
        return $this->orderBy('description', $this->input('dir', 'asc'));
    }
    
    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}