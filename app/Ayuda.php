<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Ayuda extends Model
{
    protected $table        = 'ayuda';    
    protected $fillable     = [
        'numero',
        'nombre',
        'latitud',
        'longitud',
        'cantidad',
        'alcance',
        'descripcion',
        'observacion',
        'estado',
        'aviso_id',
        'ubicacion_id',
        'tipo_luz_id',
        'tipo_color_id',
        'idioma_id'
    ];

    public function ubicacion(){
        return $this->hasMany('App\Ubicacion', 'ubicacion_id', 'id');
    }

    public function tipo_luz(){
        return $this->hasMany('App\TipoLuz', 'tipo_luz_id', 'id');
    }

    public function tipo_color(){
        return $this->hasMany('App\TipoColor', 'tipo_color_id', 'id');
    }

    public function idioma(){
        return $this->hasMany('App\Idioma', 'idioma_id', 'id');
    }

    public function aviso(){
        return $this->belongsToMany(Aviso::class);
    }
}
