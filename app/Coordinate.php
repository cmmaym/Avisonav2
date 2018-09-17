<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class Coordinate extends Model
{
    use Filterable;
    
    protected   $table      =   'coordinate';
    protected $fillable     = ['latitude', 'longitude'];

    public function symbol()
    {
        return $this->belongsToMany(Symbol::class);
    }
    
    public function novelty()
    {
        return $this->belongsToMany(Novelty::class);
    }

}
