<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use AvisoNavAPI\Traits\Observable;

class Image extends Model
{
    use Filterable, Observable;

    protected $table        = 'image';
    protected $fillable     = ['name', 'path'];

    public function symbol()
    {
        return $this->hasMany(Symbol::class);
    }
}
