<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class LightClass extends Model
{
    use Filterable;

    protected $table        = 'light_class';
    protected $fillable     = ['alias'];

    public function lightClassLangs(){
        return $this->hasMany(LightClassLang::class);
    }
    
    public function lightClassLang(){
        return $this->hasOne(LightClassLang::class);
    }

}
