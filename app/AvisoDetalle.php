<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class AvisoDetalle extends Model
{
    protected $table        = 'aviso_detalle';
    protected $fillable     = [
        'aviso_id',
        'observacion',
        'estado',
        'tipo_aviso_id',
        'tipo_caracter_id',
        'idioma_id'
    ];

    public function tipoCaracter(){
        return $this->hasMany(TipoCaracter::class, 'id', 'tipo_caracter_id');
    }

    public function tipoAviso(){
        return $this->hasMany(TipoAviso::class, 'id', 'tipo_aviso_id');
    }

    public function idioma(){
        return $this->hasMany(Idioma::class, 'id', 'idioma_id');
    }
}
