<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Zona;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table        = 'ubicacion';
    protected $primaryKey   = 'ubicacion_id';
    protected $fillable     = ['ubicacion', 'sub_ubicacion', 'estado', 'zona_id'];

    public function zona(){
        return $this->hasMany(Zona::class, 'zona_id', 'zona_id');
    }

}
