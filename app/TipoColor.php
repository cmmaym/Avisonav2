<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class TipoColor extends Model
{
    protected $table        = 'tipo_color';
    protected $primaryKey   = 'tipo_color_id';
    protected $fillable     = ['color', 'alias', 'estado'];

    public function idioma(){
        return $this->hasMany('App\Idioma', 'idioma_id', 'idioma_id');
    }
}