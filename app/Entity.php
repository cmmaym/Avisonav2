<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use Filterable;

    protected $table        = 'entity';
    protected $fillable     = ['name', 'alias', 'state'];

    public function aviso(){
        return $this->hasMany(Aviso::class);
    }
}
