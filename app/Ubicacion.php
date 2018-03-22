<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Zona;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table        = 'ubicacion';    
    protected $fillable     = ['ubicacion', 'sub_ubicacion', 'estado', 'zona_id'];

    public function zona(){
        return $this->hasMany(Zona::class, 'id', 'zona_id');
    }

}
