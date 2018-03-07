<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class TipoAviso extends Model
{
    protected $table    = 'tipo_aviso';
    protected $id       = 'tipo_aviso_id';
    protected $fillable = ['nombre', 'estado', 'idioma_id'];

    public function idioma(){
        return $this->hasMany('App\Idioma', 'idioma_id', 'idioma_id');
    }
}
