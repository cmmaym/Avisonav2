<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Notice;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use AvisoNavAPI\Traits\Observable;

class Symbol extends Model
{
    use Filterable, Observable, SpatialTrait;

    protected $table        = 'symbol';
    protected $spatialFields = [
        'position'
    ];
    protected $casts = [
        'is_legacy' => 'boolean',
    ];
    
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

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function aid(){
        return $this->hasOne(Aid::class);
    }

    public function coordinate(){
        return $this->belongsToMany(Coordinate::class, 'symbol_coordinate')
                    ->withTimestamps()
                    ->orderBy('symbol_coordinate.created_at', 'desc');
    }

    public function chart(){
        return $this->belongsToMany(Chart::class, 'symbol_chart')
                    ->withTimestamps();
    }
}
