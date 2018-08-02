<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class LightClassLang extends Model
{
    use Filterable;

    protected $table        = 'light_class_lang';
    protected $fillable     = ['class', 'description'];

    public function language(){
        return $this->belongsTo(Language::class);
    }

    public function lightClass(){
        return $this->belongsTo(LightClass::class);
    }

}
