<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Idioma;
use Illuminate\Database\Eloquent\Model;

class TipoColor extends Model
{
    protected $table        = 'tipo_color';
    protected $primaryKey   = 'tipo_color_id';
    protected $fillable     = ['color', 'alias', 'estado'];

    public function idioma(){
        return $this->hasMany(Idioma::class, 'idioma_id', 'idioma_id');
    }
}