<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table        = 'ubicacion';    
    protected $fillable     = ['ubicacion', 'sub_ubicacion', 'estado', 'zona_id'];

    public function zona(){
        return $this->belongsTo(Zona::class, 'zona_id', 'parent_id');
    }

}
