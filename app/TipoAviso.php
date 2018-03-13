<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Idioma;
use Illuminate\Database\Eloquent\Model;

class TipoAviso extends Model
{
    protected $table        = 'tipo_aviso';
    protected $primaryKey   = 'tipo_aviso_id';
    protected $fillable     = ['nombre', 'estado', 'idioma_id'];

    public function idioma(){
        return $this->hasMany(Idioma::class, 'idioma_id', 'idioma_id');
    }
}
