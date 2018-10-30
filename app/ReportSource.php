<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use AvisoNavAPI\Traits\Observable;

class ReportSource extends Model
{
    use Filterable, Observable;

    protected $table        = 'report_source';
    protected $fillable     = ['name', 'alias'];
}