<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class SymbolType extends Model
{
    use Filterable;
    
    protected   $table      =   'symbol_type';
    protected   $fillable   =   ['title'];

    public function symbol(){
        return $this->hasMany(Symbol::class);
    }
}
