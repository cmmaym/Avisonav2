<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class ReportingUser extends Model
{
    use Filterable;

    protected $table        = 'reporting_user';
    protected $fillable     = ['name'];

    public function reportSource()
    {
        return $this->belongsTo(ReportSource::class);
    }
}