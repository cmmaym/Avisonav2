<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class NoticeFilter extends ModelFilter
{
    public function number($number){
        return $this->where('number', 'like', "%$number%");
    }
    
    public function year($year){
        return $this->where('year', 'like', "%$year%");
    }

    public function reportsNumbers($reportsNumbers){
        return $this->where('reports_numbers', 'like', "%$reportsNumbers%");
    }

    public function reportDate($reportDate){
        return $this->whereRaw("(STR_TO_DATE(report_date, '%Y-%m-%d') between ? and ?)", array($reportDate, $reportDate));
    }
    
    public function createdAt($createdAt){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($createdAt, $createdAt));
    }
    
    public function user($user){
        return $this->where('user', 'like', "%$user%");
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

    public function location($location){
        $this->related('location', 'name', 'like', "%$location%");
    }

    public function zone($zone){
        $this->whereHas('location.zone.zoneLang', function($query) use ($zone) {
            $query->where('name', 'like', "%$zone%");
        });
    }

    public function reportSource($reportSource){
        return $this->related('reportSource', 'report_source.alias', 'like', "%$reportSource%");
    }
    
    public function reportingUser($reportingUser){
        return $this->related('reportingUser', 'reporting_user.name', 'like', "%$reportingUser%");
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
    
    public function sortByReportDate()
    {
        return $this->orderBy('report_date', $this->input('dir', 'asc'));
    }
    
    public function sortByCreatedAt()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }

    public function sortByUser()
    {
        return $this->orderBy('user', $this->input('dir', 'asc'));
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
    
    public function sortByZone()
    {
        $input = $this->input('dir', 'asc');

        $this->join('zone', 'notice.zone_id', '=', 'zone.id')
             ->join('zone_lang', 'zone.id', '=', 'zone_lang.zone_id')
             ->groupBy('notice.number')
             ->orderBy('zone_lang.name', $input)
             ->select('notice.*');
    }
    
    public function sortByReportSourceAlias()
    {
        $input = $this->input('dir', 'asc');

        $this->join('report_source', 'notice.report_source_id', '=', 'report_source.id')
             ->orderBy('report_source.alias', $input)
             ->select('notice.*');
    }
    
    public function sortByReportingUser()
    {
        $input = $this->input('dir', 'asc');

        $this->join('reporting_user', 'notice.reporting_user_id', '=', 'reporting_user.id')
             ->orderBy('reporting_user.name', $input)
             ->select('notice.*');
    }
}