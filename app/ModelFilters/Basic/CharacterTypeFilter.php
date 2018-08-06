<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class CharacterTypeFilter extends ModelFilter
{
    public function name($name){
        return $this->related('characterTypeLang', 'name', 'like', "%$name%");
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

    public function sortByName()
    {
        $input = $this->input('dir', 'asc');

        $this->join('character_type_lang', 'character_type_lang.character_type_id', '=', 'character_type.id')
             ->groupBy('character_type.id')
             ->orderBy('character_type_lang.name', $input)
             ->select('character_type.*');
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}