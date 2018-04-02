<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Coordenada extends Model
{
    protected   $table      =   'coordenada';
    protected   $fillable   =   [
            'latitud',
            'longitud',
            'altitud',
            'alcance',
            'cantidad',
            'estado'
    ];

    public function ayuda(){
        return $this->belongsTo(Ayuda::class);
    }

    public function coordenadaDetalle(){
        return $this->hasMany(CoordenadaDetalle::class);
    }
}
