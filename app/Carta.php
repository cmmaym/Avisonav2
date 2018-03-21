<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
    protected $table        = 'carta';    
    protected $fillable     = ['numero', 'edicion', 'ano', 'estado'];
}
