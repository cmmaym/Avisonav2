<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class Zone extends Model
{
    use Filterable;
    
    protected $table        = 'zone';
    protected $fillable     = ['state'];

    public function zoneLangs(){
        return $this->hasMany(ZoneLang::class);
    }

    public function zoneLang(){
        return $this->hasOne(ZoneLang::class);
    }

}