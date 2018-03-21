<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    protected $table        = 'idioma';    
    protected $fillable     = ['nombre', 'alias', 'estado'];
}
