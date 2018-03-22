<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Idioma;
use AvisoNavAPI\TipoColor;
use Illuminate\Database\Eloquent\Model;

class TipoColor extends Model
{
    protected $table        = 'tipo_color';    
    protected $fillable     = ['color', 'alias', 'estado', 'idioma_id'];

    public function idioma(){
        return $this->hasMany(Idioma::class, 'id', 'idioma_id');
    }

    public function tipoColor(){
        return $this->hasMany(TipoColor::class, 'parent_id');
    }

    public function parent(){
        return $this->belongsTo(TipoColor::class);
    }
}