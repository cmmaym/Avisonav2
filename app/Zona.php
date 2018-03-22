<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Idioma;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $table        = 'zona';    
    protected $fillable     = ['nombre', 'alias', 'estado', 'idioma_id'];

    public function idioma(){
        return $this->hasMany(Idioma::class, 'id', 'idioma_id');
    }

    public function zona(){
        return $this->hasMany(Zona::class, 'parent_id');
    }

    public function parent(){
        return $this->belongsTo(Zona::class);
    }
}