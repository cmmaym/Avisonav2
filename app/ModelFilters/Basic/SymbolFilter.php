<?php

namespace AvisoNavAPI\ModelFilters\Basic;

use EloquentFilter\ModelFilter;
use Illuminate\Support\Facades\DB;

class SymbolFilter extends ModelFilter
{
    public function name($name){
        $this->whereHas('symbolLang', function($query) use ($name){
            $query->where('name', 'like', "%$name%");
        });
    }

    public function symbolType($symbolType){
        $this->whereHas('symbolType', function($query) use ($symbolType){
            $query->where('title', 'like', "%$symbolType%");
        });
    }

    public function location($location){
        $this->related('location', 'location.name', 'like', "%$location%");
    }

    public function zone($zone){
        $this->whereHas('location.zone.zoneLang', function($query) use ($zone) {
            $query->where('name', 'like', "%$zone%");
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

    public function sortBySymbolType()
    {
        $input = $this->input('dir', 'asc');

        $this->join('symbol_type', 'symbol_type.id', '=', 'symbol.symbol_type_id')
             ->groupBy('symbol.id')
             ->orderBy('symbol_type.title', $input)
             ->select('symbol.*');
    }

    public function sortByLocation(){
        $input = $this->input('dir', 'asc');

        $this->join('location', 'location.id', '=', 'symbol.location_id')
             ->orderBy('location.name', $input)
             ->select('symbol.*');
    }

    public function sortByZone()
    {
        $input = $this->input('dir', 'asc');

        $this->join('location', 'symbol.location_id', '=', 'location.id')
             ->join('zone', 'location.zone_id', '=', 'zone.id')
             ->join('zone_lang', 'zone.id', '=', 'zone_lang.zone_id')
             ->groupBy('symbol.id')
             ->orderBy('zone_lang.name', $input)
             ->select('symbol.*');
    }

    public function sortByCreatedAt()
    {
        return $this->orderBy('aid.created_at', $this->input('dir', 'asc'));
    }
}