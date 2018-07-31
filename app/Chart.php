<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class Chart extends Model
{
    use Filterable;

    protected $table        = 'chart';
    protected $fillable     = ['number', 'purpose'];

    public function chartEdition(){
        return $this->hasMany(ChartEdition::class);
    }

}
