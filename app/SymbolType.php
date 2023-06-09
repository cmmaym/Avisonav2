<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use AvisoNavAPI\Traits\Observable;

class SymbolType extends Model
{
    use Filterable, Observable;
    
    protected   $table      =   'symbol_type';
    protected   $fillable   =   ['title'];

    public function symbol(){
        return $this->hasMany(Symbol::class);
    }
}
