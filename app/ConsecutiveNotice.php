<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use AvisoNavAPI\Traits\Observable;

class ConsecutiveNotice extends Model
{
    use Filterable, Observable;
    
    protected $table        = 'consecutive_notice';
    protected $fillable     = ['number', 'year'];
}
