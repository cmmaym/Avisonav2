<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use AvisoNavAPI\Traits\Observable;

class SequenceFlashes extends Model
{
    use Filterable, Observable;
    
    protected   $table      =   'sequence_flashes';
    protected   $fillable   =   ['on', 'off'];

    public function period(){
        return $this->belongsTo(Period::class);
    }
}
