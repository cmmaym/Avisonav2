<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table        = 'entity';
    protected $fillable     = ['name', 'alias', 'state'];

    public function aviso(){
        return $this->hasMany(Aviso::class);
    }
}
