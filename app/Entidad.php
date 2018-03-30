<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    protected $table        = 'entidad';
    protected $fillable     = ['nombre', 'alias', 'estado'];

    public function aviso(){
        return $this->hasMany(Aviso::class);
    }
}
