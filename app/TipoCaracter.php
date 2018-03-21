<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Idioma;
use Illuminate\Database\Eloquent\Model;

class TipoCaracter extends Model
{
    protected $table        = 'tipo_caracter';    
    protected $fillable     = ['nombre', 'estado', 'idioma_id'];

    public function idioma(){
        return $this->hasMany(Idioma::class, 'idioma_id', 'id');
    }
}
