<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class TipoAviso extends Model
{
    protected $table        = 'tipo_aviso';
    protected $fillable     = ['nombre', 'estado', 'idioma_id'];

    public function idioma(){
        return $this->hasMany(Idioma::class, 'id', 'idioma_id');
    }
    
    public function tipoAviso(){
        return $this->hasMany(TipoAviso::class, 'parent_id', 'id');
    }

    public function parent(){
        return $this->belongsTo(TipoAviso::class, 'parent_id', 'id');
    }
}
