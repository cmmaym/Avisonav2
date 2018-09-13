<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use AvisoNavAPI\Traits\Observable;

class NominalScope extends Model
{
    use Filterable, Observable;

    protected $table        = 'nominal_scope';
    protected $fillable     = ['scope', 'state'];

    public function aid(){
        return $this->belongsTo(Aid::class);
    }

}