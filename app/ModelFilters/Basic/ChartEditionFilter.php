<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class ChartEditionFilter extends ModelFilter
{
    public function scale($scale){
        return $this->where('scale', 'like', "%$scale%");
    }

    public function edition($edition){
        return $this->where('edition', 'like', "%$edition%");
    }

    public function year($year){
        return $this->where('year', 'like', "%$year%");
    }

    public function name($name){
        return $this->related('chart', 'name', 'like', "%$name%");
    }
    
    public function number($number){
        return $this->related('chart', 'number', 'like', "%$number%");
    }
    
    public function purpose($purpose){
        return $this->related('chart', 'purpose', 'like', "%$purpose%");
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

    public function sortByScale()
    {
        return $this->orderBy('scale', $this->input('dir', 'asc'));
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
    
    public function sortByName()
    {
        $input = $this->input('dir', 'asc');

        $this->join('chart', 'chart_edition.chart_id', '=', 'chart.id')
             ->groupBy('chart_edition.id')
             ->orderBy('chart.name', $input)
             ->select('chart_edition.*');
    }
    
    public function sortByPurpose()
    {
        $input = $this->input('dir', 'asc');

        $this->join('chart', 'chart_edition.chart_id', '=', 'chart.id')
             ->groupBy('chart_edition.id')
             ->orderBy('chart.purpose', $input)
             ->select('chart_edition.*');
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('chart_edition.created_at', $this->input('dir', 'asc'));
    }
}