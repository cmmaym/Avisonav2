<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class ColorLight extends Model
{
    use Filterable;
    
    protected $table        = 'color_light';
    protected $fillable     = ['alias'];

    public function colorLightLangs()
    {
        return $this->hasMany(ColorLightLang::class);
    }
    
    public function colorLightLang()
    {
        return $this->hasOne(ColorLightLang::class);
    }

}