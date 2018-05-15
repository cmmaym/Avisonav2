<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use Filterable;

    protected $table        = 'role';
    protected $fillable     = ['name', 'description'];

}
