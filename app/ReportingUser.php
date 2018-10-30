<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use AvisoNavAPI\Traits\Observable;

class ReportingUser extends Model
{
    use Filterable, Observable;

    protected $table        = 'reporting_user';
    protected $fillable     = ['name', 'rank'];

    public function reportSource()
    {
        return $this->belongsTo(ReportSource::class);
    }
}