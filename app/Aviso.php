<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Aviso extends Model
{
    protected $table        = 'aviso';    
    protected $fillable     = [
        'num_aviso',
        'fecha',
        'observacion',
        'periodo',
        'estado',
        'entidad_id',
        'tipo_carac_id',
        'tipo_aviso_id',
        'idioma_id',
        'carta_id'
    ];

    public function entidad(){
        return $this->hasMany('App\Entidad', 'entidad_id', 'id');
    }

    public function tipo_carac(){
        return $this->hasMany('App\TipoCaracter', 'tipo_carac_id', 'id');
    }

    public function tipo_aviso(){
        return $this->hasMany('App\TipoAviso', 'tipo_aviso_id', 'id');
    }

    public function idioma(){
        return $this->hasMany('App\Idioma', 'idioma_id', 'id');
    }

    public function carta(){
        return $this->hasMany('App\Carta', 'carta_id', 'id');
    }
}