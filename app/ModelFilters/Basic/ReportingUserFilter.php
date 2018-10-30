<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class ReportingUserFilter extends ModelFilter
{
    public function name($name){
        return $this->where('name', 'like', "%$name%");
    }
    
    public function rank($rank){
        return $this->where('rank', 'like', "%$rank%");
    }

    public function reportSource($reportSource){
        return $this->related('reportSource', 'report_source.alias', 'like', "%$reportSource%");
    }

    public function createdAt($createdAt){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($createdAt, $createdAt));
    }

    public function createdBy($createdBy){
        return $this->where('reporting_user.created_by', 'like', "%$createdBy%");
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('id', $this->input('dir', 'asc'));
    }

    public function sortByName()
    {
        return $this->orderBy('name', $this->input('dir', 'asc'));
    }
    
    public function sortByRank()
    {
        return $this->orderBy('rank', $this->input('dir', 'asc'));
    }

    public function sortByReportSource()
    {
        $input = $this->input('dir', 'asc');

        $this->join('report_source', 'reporting_user.report_source_id', '=', 'report_source.id')
             ->groupBy('reporting_user.id')
             ->orderBy('report_source.alias', $input)
             ->select('reporting_user.*');
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}