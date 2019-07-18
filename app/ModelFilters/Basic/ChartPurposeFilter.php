<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class ChartPurposeFilter extends ModelFilter
{
    public function purpose($purpose){
        return $this->related('chartPurposeLang', 'description', 'like', "%$purpose%");
    }

    public function createdAt($createdAt){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($createdAt, $createdAt));
    }

    public function createdBy($createdBy){
        return $this->where('chart_purpose.created_by', 'like', "%$createdBy%");
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('id', $this->input('dir', 'asc'));
    }

    public function sortByPurpose()
    {
        $input = $this->input('dir', 'asc');

        $this->join('chart_purpose_lang', 'chart_purpose_lang.chart_purpose_id', '=', 'chart_purpose.id')
             ->groupBy('chart_purpose.id')
             ->orderBy('chart_purpose_lang.description', $input)
             ->select('chart_purpose.*');
    }

    public function sortByCreatedBy()
    {
        return $this->orderBy('chart_purpose.created_by', $this->input('dir', 'asc'));
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('chart_purpose.created_at', $this->input('dir', 'asc'));
    }
}