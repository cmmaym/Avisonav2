<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class LightClassFilter extends ModelFilter
{
    public function class($class){
        return $this->related('lightClassLang', 'class', 'like', "%$class%");
    }

    public function alias($alias){
        return $this->where('alias', 'like', "%$alias%");
    }

    public function description($description){
        return $this->related('lightClassLang', 'description', 'like', "%$description%");
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

    public function sortByClass()
    {
        $input = $this->input('dir', 'asc');

        $this->join('light_Class_lang', 'light_Class_lang.light_Class_id', '=', 'light_Class.id')
             ->orderBy('light_Class_lang.class', $input)
             ->select('light_Class.*');
    }

    public function sortByAlias()
    {
        return $this->orderBy('alias', $this->input('dir', 'asc'));
    }

    public function sortByDescription()
    {
        $input = $this->input('dir', 'asc');

        $this->join('light_Class_lang', 'light_Class_lang.light_Class_id', '=', 'light_Class.id')
             ->orderBy('light_Class_lang.description', $input)
             ->select('light_Class.*');
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}