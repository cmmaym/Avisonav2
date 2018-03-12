<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    protected $table        = 'idioma';
    protected $primaryKey   = 'idioma_id';
    protected $fillable     = ['nombre', 'alias', 'estado'];

    public function getRouteKeyName()
    {
        return 'idioma_id';
    }

}
