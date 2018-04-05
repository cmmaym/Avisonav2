<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Ayuda extends Model
{
    protected $table        = 'ayuda';
    protected $fillable     = [
        'numero',
        'nombre',
        'estado'
    ];

    public function ubicacion(){
        return $this->belongsTo(Ubicacion::class);
    }

    public function coordenada(){
        return $this->hasMany(Coordenada::class);
    }

    public function aviso(){
        return $this->belongsToMany(Aviso::class);
    }
}
