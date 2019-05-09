<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class ColorStructureFilter extends ModelFilter
{
    public function name($name){
        return $this->related('colorStructureLang', 'name', 'like', "%$name%");
    }

    public function createdAt($createdAt){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($createdAt, $createdAt));
    }

    public function createdBy($createdBy){
        return $this->where('color_structure.created_by', 'like', "%$createdBy%");
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('id', $this->input('dir', 'asc'));
    }

    public function sortByName()
    {
        $input = $this->input('dir', 'asc');

        $this->join('color_structure_lang', 'color_structure_lang.color_structure_id', '=', 'color_structure.id')
             ->groupBy('color_structure_id')
             ->orderBy('color_structure_lang.name', $input)
             ->select('color_structure.*');
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