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

    public function coordenadas(){
        return $this->hasMany(Coordenada::class);
    }

    public function coordenada(){
        return $this->hasOne(Coordenada::class)
                    ->join('aviso_ayuda', function($query){
                        $query->on('coordenada.ayuda_id', 'aviso_ayuda.ayuda_id')
                              ->on('aviso_ayuda.coordenada_id', 'coordenada.id');
                    });
    }

    public function aviso(){
        return $this->belongsToMany(Aviso::class);
    }
}
