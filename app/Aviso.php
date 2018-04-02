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
        'entidad_id',
        'user_id',
    ];

    public function entidad(){
        return $this->belongsTo(Entidad::class);
    }

    public function carta(){
        return $this->belongsToMany(Carta::class)->withTimestamps();
    }

    public function avisoDetalle(){
        return $this->hasMany(AvisoDetalle::class);
    }

    public function ayuda(){
        return $this->belongsToMany(Ayuda::class)
                    ->withTimestamps()
                    ->withPivot('ayuda_version');
    }

}