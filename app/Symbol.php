<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Notice;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Symbol extends Model
{
    use Filterable;

    protected $table        = 'symbol';
    
    public function symbolLang(){
        return $this->hasOne(SymbolLang::class);
    }

    public function symbolLangs(){
        return $this->hasMany(SymbolLang::class);
    }

    public function symbolType(){
        return $this->belongsTo(SymbolType::class);
    }
    
    public function image(){
        return $this->belongsTo(Image::class);
    }

    public function aid(){
        return $this->hasOne(Aid::class);
    }

    public function coordinate(){
        return $this->belongsToMany(Coordinate::class, 'symbol_coordinate')
                    ->withTimestamps();
    }

    public function chart(){
        return $this->belongsToMany(Chart::class, 'symbol_chart')
                    ->withTimestamps();
    }
}
