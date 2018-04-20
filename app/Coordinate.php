<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    protected   $table      =   'coordinate';
    protected   $fillable   =   [
            'latitud',
            'longitud',
            'elevation',
            'scope',
            'quantity',
            'state'
    ];

    public function aidDetail(){
        return $this->belongsTo(AidDetail::class);
    }

}
