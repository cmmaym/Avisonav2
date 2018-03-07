<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
    protected $table    = 'carta';
    protected $id       = 'carta_id';
    protected $fillable = ['numero', 'edicion', 'ano', 'estado'];
}
