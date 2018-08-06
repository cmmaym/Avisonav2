<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class ChartEditionFilter extends ModelFilter
{
    public function edition($edition){
        return $this->where('edition', 'like', "%$edition%");
    }

    public function year($year){
        return $this->where('year', 'like', "%$year%");
    }

    public function number($number){
        return $this->related('chart', 'number', 'like', "%$number%");
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

    public function sortByEdition()
    {
        return $this->orderBy('edition', $this->input('dir', 'asc'));
    }
    
    public function sortByYear()
    {
        return $this->orderBy('year', $this->input('dir', 'asc'));
    }

    public function sortByNumber()
    {
        $input = $this->input('dir', 'asc');

        $this->join('chart', 'chart_edition.chart_id', '=', 'chart.id')
             ->groupBy('chart_edition.id')
             ->orderBy('chart.number', $input)
             ->select('chart_edition.*');
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('chart_edition.created_at', $this->input('dir', 'asc'));
    }
}