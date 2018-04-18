<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use Filterable;

    protected $table        = 'language';
    protected $fillable     = ['name', 'code', 'state'];

}
