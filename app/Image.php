<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use Filterable;

    protected $table        = 'image';
    protected $fillable     = ['name', 'path'];

    public function symbol()
    {
        return $this->hasMany(Symbol::class);
    }
}
