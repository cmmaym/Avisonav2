<?php

namespace AvisoNavAPI;

use AvisoNavAPI\AvisoDetalle;
use Illuminate\Database\Eloquent\Model;

class Aviso extends Model
{
    protected $table        = 'aviso';    
    protected $fillable     = [
        'num_aviso',
        'fecha',
        'periodo',
        'estado',
        'entidad_id',
        'user_id',
    ];

    public function entidad(){
        return $this->hasMany(Entidad::class, 'id', 'entidad_id');
    }

    public function carta(){
        return $this->belongsToMany(Carta::class)->withTimestamps();
    }

    public function avisoDetalle(){
        return $this->hasMany(AvisoDetalle::class, 'aviso_id');
    }

}