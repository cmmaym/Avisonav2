<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class LightTypeFilter extends ModelFilter
{
    public function class($class){
        return $this->related('lightTypeLang', 'class', 'like', "%$class%");
    }

    public function alias($alias){
        return $this->where('alias', 'like', "%$alias%");
    }

    public function description($description){
        return $this->related('lightTypeLang', 'description', 'like', "%$description%");
    }

    public function date($date){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($date, $date));
    }

    public function language($language){
        return $this->related('lightTypeLang', 'language_id', '=', $language);
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

        $this->join('light_type_lang', 'light_type_lang.light_type_id', '=', 'light_type.id')
             ->orderBy('light_type_lang.class', $input)
             ->select('light_type.*');
    }

    public function sortByAlias()
    {
        return $this->orderBy('alias', $this->input('dir', 'asc'));
    }

    public function sortByDescription()
    {
        $input = $this->input('dir', 'asc');

        $this->join('light_type_lang', 'light_type_lang.light_type_id', '=', 'light_type.id')
             ->orderBy('light_type_lang.description', $input)
             ->select('light_type.*');
    }

    public function sortByDate()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}