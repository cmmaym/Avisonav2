<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class ColorTypeFilter extends ModelFilter
{
    public function color($color){
        return $this->related('colorTypeLang', 'color', 'like', "%$color%");
    }

    public function alias($alias){
        return $this->related('colorTypeLang', 'alias', 'like', "%$alias%");
    }

    public function language($language){
        return $this->related('colorTypeLang', 'language_id', '=', $language);
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

    public function sortByColor()
    {
        $input = $this->input('dir', 'asc');

        $this->join('color_type_lang', 'color_type_lang.color_type_id', '=', 'color_type.id')
             ->orderBy('color_type_lang.color', $input)
             ->select('color_type.*');
    }

    public function sortByAlias()
    {
        $input = $this->input('dir', 'asc');

        $this->join('color_type_lang', 'color_type_lang.color_type_id', '=', 'color_type.id')
             ->orderBy('color_type_lang.alias', $input)
             ->select('color_type.*');
    }

    public function sortByDate()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}