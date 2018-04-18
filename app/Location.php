<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class Location extends Model
{
    use Filterable;

    protected $table        = 'location';
    protected $fillable     = ['name', 'sub_location_name', 'state'];

    public function zone(){
        // return $this->belongsTo(Zone::class, 'zone_id', 'parent_id');
        return $this->belongsTo(Zone::class);
    }

}
