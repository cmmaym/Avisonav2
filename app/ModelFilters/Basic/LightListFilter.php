<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class LightListFilter extends ModelFilter
{
    public function edition($edition){
        return $this->where('edition', '=', $edition);
    }

    public function year($year){
        return $this->where('year', 'like', "%$year%");
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

    public function sortByEdition()
    {
        return $this->orderBy('edition', $this->input('dir', 'asc'));
    }

    public function sortByYear()
    {
        return $this->orderBy('year', $this->input('dir', 'asc'));
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}