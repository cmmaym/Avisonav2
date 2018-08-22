<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class NoveltyFilter extends ModelFilter
{
    public function noveltyType($name){
        $this->whereHas('noveltyType.noveltyTypeLang', function($query) use ($name) {
            $query->where('name', 'like', "%$name%");
        });
    }

    public function characterType($name){
        $this->whereHas('characterType.characterTypeLang', function($query) use ($name) {
            $query->where('name', 'like', "%$name%");
        });
    }
    
    public function createdAt($createdAt){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($createdAt, $createdAt));
    }
    
    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('id', $this->input('dir', 'desc'));
    }
    
    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
    
    public function sortByCharacterType()
    {
        $input = $this->input('dir', 'asc');

        $this->join('character_type', 'notice.character_type_id', '=', 'character_type.id')
             ->join('character_type_lang', 'character_type.id', '=', 'character_type_lang.character_type_id')
             ->groupBy('novelty.id')
             ->orderBy('character_type_lang.name', $input)
             ->select('novelty.*');
    }
    
    public function sortByNoveltyType()
    {
        $input = $this->input('dir', 'asc');

        $this->join('novelty_type', 'notice.novelty_type_id', '=', 'novelty_type.id')
             ->join('novelty_type_lang', 'novelty_type.id', '=', 'novelty_type_lang.novelty_type_id')
             ->groupBy('novelty.id')
             ->orderBy('novelty_type_lang.name', $input)
             ->select('novelty.*');
    }
}