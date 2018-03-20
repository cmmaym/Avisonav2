<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Idioma;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $table        = 'zona';
    protected $primaryKey   = 'zona_id';
    protected $fillable     = ['nombre', 'alias', 'estado', 'idioma_id'];

    public function idioma(){
        return $this->hasMany(Idioma::class, 'idioma_id', 'idioma_id');
    }
}