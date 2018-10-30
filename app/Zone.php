<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use AvisoNavAPI\Traits\Observable;

class Zone extends Model
{
    use Filterable, Observable;
    
    protected $table        = 'zone';

    public function zoneLangs(){
        return $this->hasMany(ZoneLang::class);
    }

    public function zoneLang(){
        return $this->hasOne(ZoneLang::class);
    }

}