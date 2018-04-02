<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $table        = 'version';
    protected $fillable     = [
        'numero_ayuda',
        'ubicacion',
        'version'
    ];
}
