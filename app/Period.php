<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use AvisoNavAPI\Traits\Observable;

class Period extends Model
{
    use Filterable, Observable;

    protected $table        = 'period';
    protected $fillable     = ['time', 'flash_group', 'state'];

    public function sequenceFlashes()
    {
        return $this->hasMany(SequenceFlashes::class);
    }

    public function aid(){
        return $this->belongsTo(Aid::class);
    }

}