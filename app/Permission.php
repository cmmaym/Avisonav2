<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use Filterable;

    protected $table        = 'permission';
    protected $fillable     = ['name', 'description'];

}
