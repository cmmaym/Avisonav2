<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;

class AidFilter extends ModelFilter
{

    public function subName($subName){
        return $this->where('sub_name', 'like', "%$subName%");
    }

    public function elevation($elevation){
        return $this->where('elevation', '=', $elevation);
    }

    public function scope($scope){
        return $this->where('scope', '=', $scope);
    }

    public function quiantity($quiantity){
        return $this->where('quantity', '=', $quiantity);
    }

    public function observation($observation){
        return $this->where('observation', 'like', "%$observation%");
    }

    public function name($name){
        $this->whereHas('aidType.aidType', function($query) use ($name){
            $query->where('name', 'like', "%$name%");
        });
    }

    public function location($name){
        return $this->related('location', 'name', 'like', "%$name%");
    }

    public function date($date){
        return $this->whereRaw("(STR_TO_DATE(created_at, '%Y-%m-%d') between ? and ?)", array($date, $date));
    }

    public function sort($column)
    {
        if(method_exists($this, $method = 'sortBy' . studly_case($column))) {
            return $this->$method();
        }

        return $this->orderBy('id', $this->input('dir', 'asc'));
    }

    public function sortBySubName()
    {
        return $this->orderBy('sub_name', $this->input('dir', 'asc'));
    }

    public function sortByElevation()
    {
        return $this->orderBy('elevation', $this->input('dir', 'asc'));
    }

    public function sortByScope()
    {
        return $this->orderBy('scope', $this->input('dir', 'asc'));
    }

    public function sortByQuantity()
    {
        return $this->orderBy('quantity', $this->input('dir', 'asc'));
    }

    public function sortByObservation()
    {
        return $this->orderBy('observation', $this->input('dir', 'asc'));
    }

    public function sortByName()
    {
        $input = $this->input('dir', 'asc');
        $language =  $this->input('language');

        $this->join('aid_type', 'aid_type.id', '=', 'aid.aid_type_id')
             ->join('aid_type_lang', 'aid_type_lang.aid_type_id', '=', 'aid_type.id')
             ->where('aid_type_lang.language_id', '=', $language)
             ->orderBy('aid_type_lang.name', $input)
             ->select('aid.*');
    }

    public function sortByLocation(){
        $input = $this->input('dir', 'asc');

        $this->join('location', 'location.id', '=', 'aid.location_id')
             ->orderBy('location.name', $input)
             ->select('aid.*');
    }

    public function sortByDate()
    {
        return $this->orderBy('created_at', $this->input('dir', 'asc'));
    }
}