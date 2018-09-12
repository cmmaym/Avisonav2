<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use Filterable;

    protected $table        = 'period';
    protected $fillable     = ['time', 'flash_group', 'state'];

    public function aid(){
        return $this->belongsTo(Aid::class);
    }

}