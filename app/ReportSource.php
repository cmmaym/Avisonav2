<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class ReportSource extends Model
{
    use Filterable;

    protected $table        = 'report_source';
    protected $fillable     = ['name', 'alias'];
}