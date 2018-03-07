<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Ayuda extends Model
{
    protected $table    = 'ayuda';
    protected $id       = 'ayuda_id';
    protected $fillable = [
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

    public function aviso(){
        return $this->hasMany('App\Aviso', 'aviso_id', 'aviso_id');
    }

    public function ubicacion(){
        return $this->hasMany('App\Ubicacion', 'ubicacion_id', 'ubicacion_id');
    }

    public function tipo_luz(){
        return $this->hasMany('App\TipoLuz', 'tipo_luz_id', 'tipo_luz_id');
    }

    public function tipo_color(){
        return $this->hasMany('App\TipoColor', 'tipo_color_id', 'tipo_color_id');
    }

    public function idioma(){
        return $this->hasMany('App\Idioma', 'idioma_id', 'idioma_id');
    }
}
