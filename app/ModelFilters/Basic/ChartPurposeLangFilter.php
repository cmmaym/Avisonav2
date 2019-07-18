<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class ChartPurposeLangFilter extends ModelFilter
{
    public function purpose($purpose)
    {
        return $this->where('description', 'like', "%$purpose%");
    }

    public function language($language){
        return $this->related('language', 'name', 'like', "%$language%");
    }

    public function createdAt($createdAt){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($createdAt, $createdAt));
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('zone_id', $this->input('dir', 'asc'));
    }

    public function sortByPurpose()
    {
        return $this->orderBy('description', $this->input('dir', 'asc'));
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}