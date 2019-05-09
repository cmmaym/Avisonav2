<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class ChartFilter extends ModelFilter
{
    public function number($number){
        return $this->where('number', 'like', "%$number%");
    }

    public function name($name){
        return $this->where('name', 'like', "%$name%");
    }
    
    public function scale($scale){
        return $this->where('scale', 'like', "%$scale%");
    }
    
    public function purpose($purpose){
        return $this->where('purpose', 'like', "%$purpose%");
    }

    public function createdAt($createdAt){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($createdAt, $createdAt));
    }

    public function createdBy($createdBy){
        return $this->where('chart.created_by', 'like', "%$createdBy%");
    }
    
    public function edition($edition){
        return $this->related('chartEdition', 'chart_edition.edition', 'like', "%$edition%");
    }
    
    public function year($year){
        return $this->related('chartEdition', 'chart_edition.year', 'like', "%$year%");
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
    
    public function sortByName()
    {
        return $this->orderBy('name', $this->input('dir', 'asc'));
    }

    public function sortByPurpose()
    {
        return $this->orderBy('purpose', $this->input('dir', 'asc'));
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('chart.created_at', $this->input('dir', 'asc'));
    }

    public function sortByScale(){
        return $this->orderBy('scale', $this->input('dir', 'asc'));
    }
    
    public function sortByEdition(){
        $input = $this->input('dir', 'asc');

        $this->join('chart_edition', 'chart_edition.chart_id', '=', 'chart.id')
             ->groupBy('chart.id')
             ->orderBy('chart_edition.edition', $input)
             ->select('chart.*');
    }
    
    public function sortByYear(){
        $input = $this->input('dir', 'asc');

        $this->join('chart_edition', 'chart_edition.chart_id', '=', 'chart.id')
             ->groupBy('chart.id')
             ->orderBy('chart_edition.year', $input)
             ->select('chart.*');
    }

    public function sortByIsLegacy(){
        return $this->orderBy('is_legacy', $this->input('dir', 'asc'));
    }
}