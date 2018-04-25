<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class NoticeFilter extends ModelFilter
{
    public function notice($number){
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
    
    // public function observation($observation){
    //     return $this->related('noticeDetail', 'notice_detail.observation', 'like', "%$observation%");
    // }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('id', $this->input('dir', 'desc'));
    }

    public function sortByNotice()
    {
        return $this->orderBy('number', $this->input('dir', 'asc'));
    }
    
    public function sortByDate()
    {
        return $this->orderBy('date', $this->input('dir', 'asc'));
    }
    
    public function sortByAlias()
    {
        return $this->orderBy('alias', $this->input('dir', 'asc'));
    }
}