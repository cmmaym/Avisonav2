<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class NoticeFilter extends ModelFilter
{
    public function number($number){
        return $this->where('number', 'like', "%$number%");
    }
    
    public function date($date){
        return $this->whereRaw("(STR_TO_DATE(date, '%Y-%m-%d') between ? and ?)", array($date, $date));
    }

    public function periodo($periodo){
        return $this->where('periodo', '=', $periodo);
    }

    public function entity($name){
        return $this->related('entity', 'entity.name', 'like', "%$name%");
    }
    
    public function character($name){
        $this->whereHas('characterType.characterTypeLang', function($query) use ($name) {
            $query->where('name', 'like', "%$name%");
        });
    }

    public function language($language){
        // $this->related('noticeLang', 'notice_lang.language_id', '=', $language);
        $this->whereHas('characterType.characterTypeLang', function($query) use ($language) {
            $query->where('language_id', $language);
        });
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
    
    public function sortByDate()
    {
        return $this->orderBy('date', $this->input('dir', 'asc'));
    }
    
    public function sortByEntity()
    {
        $input = $this->input('dir', 'asc');

        $this->join('entity', 'notice.entity_id', '=', 'entity.id')
             ->orderBy('entity.name', $input)
             ->select('notice.*');
    }
}