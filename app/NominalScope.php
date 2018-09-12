<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class NominalScope extends Model
{
    use Filterable;

    protected $table        = 'nominal_scope';
    protected $fillable     = ['scope', 'state'];

    public function aid(){
        return $this->belongsTo(Aid::class);
    }

}