<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;
use Illuminate\Support\Facades\DB;

class AidFilter extends ModelFilter
{
    public function name($name){
        $this->whereHas('symbol.symbolLang', function($query) use ($name){
            $query->where('name', 'like', "%$name%");
        });
    }

    public function racon($racon){
        return $this->where('racon', '=', $racon);
    }
    
    public function ais($ais){
        return $this->where('ais', '=', $ais);
    }
    
    public function height($height){
        return $this->where('height', 'like', "%$height%");
    }
    
    public function elevationNmm($elevationNmm){
        return $this->where('elevation_nmm', 'like', "%$elevationNmm%");
    }
    
    public function scope($scope){
        return $this->where('scope', 'like', "%$scope%");
    }
    
    public function sectorAngle($sectorAngle){
        return $this->where('sector_angle', 'like', "%$sectorAngle%");
    }
    
    public function createdBy($user){
        return $this->where('created_by', 'like', "%$user%");
    }
    
    public function location($name){
        $this->whereHas('symbol.location', function($query) use ($name){
            $query->where('name', 'like', "%$name%");
        });
    }

    public function lightClass($lightClass){
        $this->whereHas('lightClass.lightClassLang', function($query) use ($lightClass){
            $query->where('class', 'like', "%$lightClass%");
        });
    }
    
    public function colorStructurePattern($colorStructurePattern){
        $this->whereHas('colorStructurePattern.colorStructureLang', function($query) use ($colorStructurePattern){
            $query->where('name', 'like', "%$colorStructurePattern%");
        });
    }
    
    public function topMark($topMark){
        $this->whereHas('topMark.topMarkLang', function($query) use ($topMark){
            $query->where('description', 'like', "%$topMark%");
        });
    }
    
    public function aidType($aidType){
        $this->whereHas('aidType.aidTypeLang', function($query) use ($aidType){
            $query->where('name', 'like', "%$aidType%");
        });
    }
    
    public function aidTypeForm($aidTypeForm){
        $this->whereHas('aidTypeForm.aidTypeFormLang', function($query) use ($aidTypeForm){
            $query->where('description', 'like', "%$aidTypeForm%");
        });
    }

    public function latitud($latitud){
        return $this->related('coordinate', DB::raw('CONCAT(latitude_degrees, latitude_minutes, latitude_seconds)'), 'like', "%$latitud%");
    }
    
    public function longitud($longitud){
        return $this->related('coordinate', DB::raw('CONCAT(longitude_degrees, longitude_minutes, longitude_seconds)'), 'like', "%$longitud%");
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

    public function sortByName()
    {
        $input = $this->input('dir', 'asc');

        $this->join('symbol', 'symbol.id', '=', 'aid.symbol_id')
             ->join('symbol_lang', 'symbol_lang.symbol_id', '=', 'symbol.id')
             ->groupBy('aid.id')
             ->orderBy('symbol.name', $input)
             ->select('aid.*');
    }

    public function sortByRacon()
    {
        return $this->orderBy('racon', $this->input('dir', 'asc'));
    }
    
    public function sortByAis()
    {
        return $this->orderBy('ais', $this->input('dir', 'asc'));
    }
    
    public function sortByHeight()
    {
        return $this->orderBy('height', $this->input('dir', 'asc'));
    }
    
    public function sortByElevationNmm()
    {
        return $this->orderBy('elevation_nmm', $this->input('dir', 'asc'));
    }
    
    public function sortByScope()
    {
        return $this->orderBy('scope', $this->input('dir', 'asc'));
    }
    
    public function sortBySectorAngle()
    {
        return $this->orderBy('sector_angle', $this->input('dir', 'asc'));
    }
    
    public function sortByCreatedBy()
    {
        return $this->orderBy('created_by', $this->input('dir', 'asc'));
    }
    
    public function sortByLocation(){
        $input = $this->input('dir', 'asc');

        $this->join('location', 'location.id', '=', 'aid.location_id')
             ->orderBy('location.name', $input)
             ->select('aid.*');
    }
    
    public function sortByLightClass()
    {
        $input = $this->input('dir', 'asc');

        $this->join('light_class', 'light_class.id', '=', 'aid.light_class_id')
             ->join('light_class_lang', 'light_class_lang.light_class_id', '=', 'light_class.id')
             ->groupBy('aid.id')
             ->orderBy('light_class_lang.class', $input)
             ->select('aid.*');
    }
    
    public function sortByColorStructurePattern()
    {
        $input = $this->input('dir', 'asc');

        $this->join('color_structure', 'color_structure.id', '=', 'aid.color_structure_pattern_id')
             ->join('color_structure_lang', 'color_structure_lang.color_structure_id', '=', 'color_structure.id')
             ->groupBy('aid.id')
             ->orderBy('color_structure_lang.name', $input)
             ->select('aid.*');
    }
    
    public function sortByTopMark()
    {
        $input = $this->input('dir', 'asc');

        $this->join('top_mark', 'top_mark.id', '=', 'aid.top_mark_id')
             ->join('top_mark_lang', 'top_mark_lang.top_mark_id', '=', 'top_mark.id')
             ->groupBy('aid.id')
             ->orderBy('top_mark_lang.description', $input)
             ->select('aid.*');
    }
    
    public function sortByAidType()
    {
        $input = $this->input('dir', 'asc');

        $this->join('aid_type', 'aid_type.id', '=', 'aid.aid_type_id')
             ->join('aid_type_lang', 'aid_type_lang.aid_type_id', '=', 'aid_type.id')
             ->groupBy('aid.id')
             ->orderBy('aid_type_lang.name', $input)
             ->select('aid.*');
    }
    
    public function sortByAidTypeForm()
    {
        $input = $this->input('dir', 'asc');

        $this->join('aid_type_form', 'aid_type_form.id', '=', 'aid.aid_type_form_id')
             ->join('aid_type_form_lang', 'aid_type_form_lang.aid_type_form_id', '=', 'aid_type_form.id')
             ->groupBy('aid.id')
             ->orderBy('aid_type_form_lang.name', $input)
             ->select('aid.*');
    }

    public function sortByLatitud()
    {
        $input = $this->input('dir', 'asc');

        $this->join('coordinate', 'coordinate.aid_id', '=', 'aid.id')
             ->groupBy('aid.id')
            ->orderBy(DB::raw('CONCAT(latitude_degrees, latitude_minutes, latitude_seconds)'), $input)
             ->select('aid.*');
    }
    
    public function sortByLongitud()
    {
        $input = $this->input('dir', 'asc');

        $this->join('coordinate', 'coordinate.aid_id', '=', 'aid.id')
             ->groupBy('aid.id')
             ->orderBy(DB::raw('CONCAT(longitude_degrees, longitude_minutes, longitude_seconds)'), $input)
             ->select('aid.*');
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('aid.created_at', $this->input('dir', 'asc'));
    }
}