<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class NoticeFilter extends ModelFilter
{
    public function number($number){
        return $this->where('number', 'like', "%$number%");
    }
    
    public function date($date){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($date, $date));
    }

    public function year($year){
        return $this->where('year', 'like', "%$year%");
    }

    public function entity($name){
        return $this->related('entity', 'entity.name', 'like', "%$name%");
    }
    
    public function characterType($name){
        $this->whereHas('characterType.characterTypeLang', function($query) use ($name) {
            $query->where('name', 'like', "%$name%");
        });
    }
    
    public function noveltyType($name){
        $this->whereHas('noveltyType.noveltyTypeLang', function($query) use ($name) {
            $query->where('name', 'like', "%$name%");
        });
    }

    public function user($user){
        return $this->where('user', 'like', "%$user%");
    }
    
    public function observation($observation){
        return $this->related('noticeLang', 'notice_lang.observation', 'like', "%$observation%");
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('id', $this->input('dir', 'desc'));
    }

    public function sortByNumber()
    {
        return $this->orderBy('number', $this->input('dir', 'asc'));
    }
    
    public function sortByYear()
    {
        return $this->orderBy('year', $this->input('dir', 'asc'));
    }
    
    public function sortByDate()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
    
    public function sortByCharacterType()
    {
        $input = $this->input('dir', 'asc');

        $this->join('character_type', 'notice.character_type_id', '=', 'character_type.id')
             ->join('character_type_lang', 'character_type.id', '=', 'character_type_lang.character_type_id')
             ->groupBy('notice.number')
             ->orderBy('character_type_lang.name', $input)
             ->select('notice.*');
    }
    
    public function sortByNoveltyType()
    {
        $input = $this->input('dir', 'asc');

        $this->join('novelty_type', 'notice.novelty_type_id', '=', 'novelty_type.id')
             ->join('novelty_type_lang', 'novelty_type.id', '=', 'novelty_type_lang.novelty_type_id')
             ->groupBy('notice.number')
             ->orderBy('novelty_type_lang.name', $input)
             ->select('notice.*');
    }
    
    public function sortByEntity()
    {
        $input = $this->input('dir', 'asc');

        $this->join('entity', 'notice.entity_id', '=', 'entity.id')
             ->orderBy('entity.name', $input)
             ->select('notice.*');
    }
}