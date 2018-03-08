<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class TipoCaracter extends Model
{
    protected $table        = 'tipo_caracter';
    protected $primaryKey   = 'tipo_carac_id';
    protected $fillable     = ['nombre', 'estado', 'idioma_id'];

    public function idioma(){
        return $this->hasMany('App\Idioma', 'idioma_id', 'idioma_id');
    }
}
