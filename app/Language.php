<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table        = 'language';
    protected $fillable     = ['name', 'code', 'state'];

}
