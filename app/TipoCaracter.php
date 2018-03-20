<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Idioma;
use Illuminate\Database\Eloquent\Model;

class TipoCaracter extends Model
{
    protected $table        = 'tipo_caracter';
    protected $primaryKey   = 'tipo_carac_id';
    protected $fillable     = ['nombre', 'estado', 'idioma_id'];

    public function idioma(){
        return $this->hasMany(Idioma::class, 'idioma_id', 'idioma_id');
    }
}
