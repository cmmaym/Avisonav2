<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class CoordenadaDetalle extends Model
{
    protected   $table      =   'coordenada_detalle';
    protected   $fillable   =   [
            'descripcion',
            'observacion',
            'estado'
    ];

    public function coordenada(){
        return $this->belongsTo(Coordenada::class);
    }

    public function tipoLuz(){
        return $this->belongsTo(TipoLuz::class);
    }

    public function tipoColor(){
        return $this->belongsTo(TipoColor::class);
    }

    public function idioma(){
        return $this->belongsTo(Idioma::class);
    }

    public function parent(){
        return $this->belongsTo(CoordenadaDetalle::class);
    }

    public function coordenadaDetalle(){
        return $this->hasMany(CoordenadaDetalle::class, 'parent_id');
    }
}
