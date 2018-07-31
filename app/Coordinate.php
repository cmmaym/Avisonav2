<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class Coordinate extends Model
{
    use Filterable;
    
    protected   $table      =   'coordinate';
    protected   $fillable   =   ['latitud', 'longitud'];

    public function aid()
    {
        return $this->belongsTo(Aid::class);
    }

}
