<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class TipoLuz extends Model
{
    protected $table        = 'tipo_luz';
    protected $primaryKey   = 'tipo_luz_id';
    protected $fillable     = ['clase', 'alias', 'descripcion', 'ilustracion', 'estado', 'idioma_id'];

    public function idioma(){
        return $this->hasMany('App\Idioma', 'idioma_id', 'idioma_id');
    }
}
