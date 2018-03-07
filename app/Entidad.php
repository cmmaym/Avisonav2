<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    protected $table    = 'entidad';
    protected $id       = 'entidad_id';
    protected $fillable = ['nombre', 'alias', 'estado'];
}
