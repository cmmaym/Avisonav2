<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table    = 'ubicacion';
    protected $id       = 'ubicacion_id';
    protected $fillable = ['ubicacion', 'sub_ubicacion', 'estado'];
}
