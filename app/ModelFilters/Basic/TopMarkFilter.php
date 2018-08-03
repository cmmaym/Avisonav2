<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class TopMarkFilter extends ModelFilter
{
    public function description($description){
        return $this->related('topMarkLang', 'description', 'like', "%$description%");
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

    public function sortByDescription()
    {
        $input = $this->input('dir', 'asc');

        $this->join('top_mark_lang', 'top_mark_lang.top_mark_id', '=', 'top_mark.id')
             ->orderBy('top_mark_lang.description', $input)
             ->select('top_mark.*');
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}