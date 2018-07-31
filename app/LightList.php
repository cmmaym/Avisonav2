<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class LightList extends Model
{
    use Filterable;

    protected $table        = 'light_list';
    protected $fillable     = ['edition', 'year'];
}