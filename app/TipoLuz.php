<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Idioma;
use Illuminate\Database\Eloquent\Model;

class TipoLuz extends Model
{
    protected $table        = 'tipo_luz';    
    protected $fillable     = ['clase', 'alias', 'descripcion', 'illustracion', 'estado', 'idioma_id'];

    public function idioma(){
        return $this->hasMany(Idioma::class, 'idioma_id', 'id');
    }
}
