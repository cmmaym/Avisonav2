<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use AvisoNavAPI\Traits\Observable;

class ColorLightLang extends Model
{
    use Filterable, Observable;

    protected $table        = 'color_light_lang';
    protected $fillable     = ['color'];

    public function language(){
        return $this->belongsto(Language::class);
    }

    public function colorLight(){
        return $this->belongsTo(ColorLight::class);
    }

}
