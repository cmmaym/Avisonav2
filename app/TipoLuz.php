<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class TipoLuz extends Model
{
    protected $table        = 'tipo_luz';    
    protected $fillable     = ['clase', 'alias', 'descripcion', 'illustracion', 'estado', 'idioma_id'];

    public function idioma(){
        return $this->hasMany(Idioma::class, 'id', 'idioma_id');
    }

    public function tipoLuz(){
        return $this->hasMany(TipoLuz::class, 'parent_id');
    }

    public function parent(){
        return $this->belongsTo(TipoLuz::class);
    }
}
