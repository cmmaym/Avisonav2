<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class ChartFilter extends ModelFilter
{
    public function number($number){
        return $this->where('number', '=', $number);
    }

    public function purpose($purpose){
        return $this->where('purpose', 'like', "%$purpose%");
    }

    public function date($date){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($date, $date));
    }

    public function edition($number){
        return $this->related('chartEdition', 'chart_edition.number', '=', $number);
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('id', $this->input('dir', 'asc'));
    }

    public function sortByNumber()
    {
        return $this->orderBy('number', $this->input('dir', 'asc'));
    }

    public function sortByPurpose()
    {
        return $this->orderBy('purpose', $this->input('dir', 'asc'));
    }

    public function sortByDate()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}