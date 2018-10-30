<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use AvisoNavAPI\Traits\Observable;

class LightList extends Model
{
    use Filterable, Observable;

    protected $table        = 'light_list';
    protected $fillable     = ['edition', 'year'];
}