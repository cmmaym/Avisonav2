<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use AvisoNavAPI\Traits\Observable;

class Coordinate extends Model
{
    use Filterable, Observable;
    
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
