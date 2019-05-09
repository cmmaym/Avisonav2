<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class ColorLightFilter extends ModelFilter
{
    public function color($color){
        return $this->related('colorLightLang', 'color', 'like', "%$color%");
    }

    public function alias($alias){
        return $this->where('alias', 'like', "%$alias%");
    }

    public function createdAt($createdAt){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($createdAt, $createdAt));
    }

    public function createdBy($createdBy){
        return $this->where('color_light.created_by', 'like', "%$createdBy%");
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

        $this->join('color_light_lang', 'color_light_lang.color_light_id', '=', 'color_light.id')
             ->groupBy('color_light.id')
             ->orderBy('color_light_lang.color', $input)
             ->select('color_light.*');
    }

    public function sortByAlias()
    {
        return $this->orderBy('alias', $this->input('dir', 'asc'));
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }

    public function sortByIsLegacy()
    {
        return $this->orderBy('is_legacy', $this->input('dir', 'asc'));
    }
}