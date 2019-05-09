<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use AvisoNavAPI\Traits\Observable;

class Location extends Model
{
    use Filterable, Observable;

    protected $table        = 'location';
    protected $fillable     = ['name', 'sub_location_name'];
    protected $casts = [
        'is_legacy' => 'boolean',
    ];

    public function zone(){
        return $this->belongsTo(Zone::class);
    }

}
