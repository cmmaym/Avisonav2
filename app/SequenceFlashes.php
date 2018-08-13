<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class SequenceFlashes extends Model
{
    use Filterable;
    
    protected   $table      =   'sequence_flashes';
    protected   $fillable   =   ['on', 'off'];

    public function aid(){
        return $this->belongsTo(Aid::class);
    }
}
