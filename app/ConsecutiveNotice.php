<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class ConsecutiveNotice extends Model
{
    protected $table        = 'consecutive_notice';
    protected $fillable     = ['number', 'year'];
}
