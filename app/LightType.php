<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class LightType extends Model
{
    use Filterable;

    protected $table        = 'light_type';
    protected $fillable     = ['illustration', 'state'];

    public function lightTypeLangs(){
        return $this->hasMany(LightTypeLang::class);
    }
    
    public function lightTypeLang(){
        return $this->hasOne(LightTypeLang::class);
    }

}
