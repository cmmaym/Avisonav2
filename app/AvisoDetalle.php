<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Aviso;
use Illuminate\Database\Eloquent\Model;

class AvisoDetalle extends Model
{
    protected $table        = 'aviso_detalle';
    protected $fillable     = [
        'observacion',
        'tipo_aviso_id',
        'tipo_caracter_id',
        'idioma_id'
    ];

    public function tipoCaracter(){
        return $this->belongsTo(TipoCaracter::class);
    }

    public function tipoAviso(){
        return $this->belongsTo(TipoAviso::class);
    }

    public function idioma(){
        return $this->belongsTo(Idioma::class);
    }

    public function aviso(){
        return $this->belongsTo(Aviso::class);
    }
}
