<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class SymbolLang extends Model
{
    use Filterable;
    
    protected   $table      =   'symbol_lang';
    protected   $fillable   =   ['name'];

    public function symbol(){
        return $this->belongsTo(Symbol::class);
    }

    public function language(){
        return $this->belongsTo(Language::class);
    }

}
