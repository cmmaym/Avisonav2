<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use AvisoNavAPI\Traits\Observable;

class ChartPurpose extends Model
{
    use Filterable, Observable;

    protected $table        = 'chart_purpose';

    public function chart(){
        return $this->hasMany(Chart::class);
    }

    public function chartPurposeLang(){
        return $this->hasOne(ChartPurposeLang::class);
    }

    public function chartPurposeLangs(){
        return $this->hasMany(ChartPurposeLang::class);
    }
}
