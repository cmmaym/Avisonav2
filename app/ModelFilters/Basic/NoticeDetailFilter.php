<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class NoticeDetailFilter extends ModelFilter
{
    public function observation($observation)
    {
        return $this->where('observation', 'like', "%$observation%");
    }
    
    public function date($date)
    {
        return $this->whereRaw("(STR_TO_DATE(date, '%Y-%m-%d') between ? and ?)", array($date, $date));
    }
    
    public function character($character){
        return $this->related('characterType', 'character_type', 'like', "%$character%");
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('id', $this->input('dir', 'desc'));
    }

    public function sortByObservation()
    {
        return $this->orderBy('observation', $this->input('dir', 'asc'));
    }
    
    public function sortByDate()
    {
        return $this->orderBy('date', $this->input('dir', 'asc'));
    }
    
    public function sortByCharacter()
    {
        return $this->orderBy('alias', $this->input('dir', 'asc'));
        $input = $this->input('dir', 'asc');

        $this->join('character', 'notice_detail.character_type_id', '=', 'character.id')
             ->orderBy('character_type.name', $input)
             ->select('character.*');
    }
}