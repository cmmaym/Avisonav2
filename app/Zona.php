<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $table        = 'zona';
    protected $primaryKey   = 'zona_id';
    protected $fillable     = ['nombre', 'alias', 'estado', 'idioma_id'];

    public function idioma(){
        return $this->hasMany('App\Idioma', 'idioma_id', 'idioma_id');
    }
}