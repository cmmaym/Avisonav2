<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Idioma;
use Illuminate\Database\Eloquent\Model;

class TipoCaracter extends Model
{
    protected $table        = 'tipo_caracter';    
    protected $fillable     = ['nombre', 'estado', 'idioma_id'];

    public function idioma(){
        return $this->hasMany(Idioma::class, 'id', 'idioma_id');
    }

    public function tipoCaracter(){
        return $this->hasMany(TipoCaracter::class, 'parent_id');
    }

    public function parent(){
        return $this->belongsTo(TipoCaracter::class);
    }
}
