<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class LightClassFilter extends ModelFilter
{
    public function class($class){
        return $this->whereHas('lightClassLang', function($query) use ($class){
                    $query->where('class', 'like', "%$class%")
                          ->where('language.code', '=', 'es')
                          ->join('language', 'language.id', '=', 'light_class_lang.language_id');
        });
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

    public function createdBy($createdBy){
        return $this->where('light_class.created_by', 'like', "%$createdBy%");
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

        $this->join('light_class_lang', 'light_class_lang.light_class_id', '=', 'light_class.id')
             ->groupBy('light_class.id')
             ->orderBy('light_class_lang.class', $input)
             ->select('light_class.*');
    }

    public function sortByAlias()
    {
        return $this->orderBy('alias', $this->input('dir', 'asc'));
    }

    public function sortByDescription()
    {
        $input = $this->input('dir', 'asc');

        $this->join('light_class_lang', 'light_class_lang.light_class_id', '=', 'light_class.id')
             ->groupBy('light_class.id')
             ->orderBy('light_class_lang.description', $input)
             ->select('light_class.*');
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}