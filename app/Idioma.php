<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    protected $table    = 'idioma';
    protected $id       = 'idioma_id';
    protected $fillable = ['nombre', 'alias', 'estado'];

}
