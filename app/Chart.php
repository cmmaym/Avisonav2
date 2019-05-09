<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use EloquentFilter\Filterable;
use AvisoNavAPI\Traits\Observable;

class Chart extends Model
{
    use Filterable, Observable, SpatialTrait;

    protected $table        = 'chart';
    protected $fillable     = ['number', 'name', 'scale', 'purpose'];
    protected $spatialFields = [
        'area'
    ];
    protected $casts = [
        'is_legacy' => 'boolean',
    ];

    public function chartEdition(){
        return $this->hasMany(ChartEdition::class);
    }
    
    public function edition(){
        return $this->hasOne(ChartEdition::class);
    }

}
