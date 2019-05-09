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

    public function sortByCreatedAt()
    {
        return $this->orderBy('aid.created_at', $this->input('dir', 'asc'));
    }
}