<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use AvisoNavAPI\Traits\Observable;

class ColorLight extends Model
{
    use Filterable, Observable;
    
    protected $table        = 'color_light';
    protected $fillable     = ['alias'];
    protected $casts = [
        'is_legacy' => 'boolean',
    ];

    public function colorLightLangs()
    {
        return $this->hasMany(ColorLightLang::class);
    }
    
    public function colorLightLang()
    {
        return $this->hasOne(ColorLightLang::class);
    }

}