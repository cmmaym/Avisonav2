<?php

namespace AvisoNavAPI;

use AvisoNavAPI\CoordenadaDetalle;
use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    protected $table        = 'idioma';
    protected $fillable     = ['nombre', 'alias', 'estado'];

}
