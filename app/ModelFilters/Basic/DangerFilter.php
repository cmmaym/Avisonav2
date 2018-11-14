<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;
use Illuminate\Support\Facades\DB;

class DangerFilter extends ModelFilter
{
    public function name($name){
        $this->whereHas('symbolLang', function($query) use ($name){
            $query->where('name', 'like', "%$name%");
        });
    }
    
    public function createdBy($user){
        return $this->where('symbol.created_by', 'like', "%$user%");
    }
    
    public function location($name){
        $this->whereHas('location', function($query) use ($name){
            $query->where('name', 'like', "%$name%");
        });
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

        $this->join('symbol_lang', 'symbol_lang.symbol_id', '=', 'symbol.id')
             ->groupBy('symbol.id')
             ->orderBy('name', $input)
             ->select('symbol.*');
    }

    public function sortByCreatedBy()
    {
        return $this->orderBy('created_by', $this->input('dir', 'asc'));
    }
    
    public function sortByLocation(){
        $input = $this->input('dir', 'asc');

        $this->join('location', 'location.id', '=', 'symbol.location_id')
             ->orderBy('location.name', $input)
             ->select('symbol.*');
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('symbol.created_at', $this->input('dir', 'asc'));
    }
}