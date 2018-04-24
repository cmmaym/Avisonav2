<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class ColorType extends Model
{
    use Filterable;
    
    protected $table        = 'color_type';
    protected $fillable     = ['state'];

    public function colorTypeLangs(){
        return $this->hasMany(ColorTypeLang::class);
    }

}