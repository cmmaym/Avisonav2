<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class NoveltyTypeFilter extends ModelFilter
{
    public function name($name){
        return $this->related('noveltyTypeLang', 'name', 'like', "%$name%");
    }
    
    public function description($description){
        return $this->related('noveltyTypeLang', 'description', 'like', "%$description%");
    }

    public function createdAt($createdAt){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($createdAt, $createdAt));
    }

    public function createdBy($createdBy){
        return $this->where('novelty_type.created_by', 'like', "%$createdBy%");
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

        $this->join('novelty_type_lang', 'novelty_type_lang.novelty_type_id', '=', 'novelty_type.id')
             ->groupBy('novelty_type.id')
             ->orderBy('novelty_type_lang.name', $input)
             ->select('novelty_type.*');
    }
    
    public function sortByDescription()
    {
        $input = $this->input('dir', 'asc');

        $this->join('novelty_type_lang', 'novelty_type_lang.novelty_type_id', '=', 'novelty_type.id')
             ->groupBy('novelty_type.id')
             ->orderBy('novelty_type_lang.description', $input)
             ->select('novelty_type.*');
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