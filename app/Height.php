<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use AvisoNavAPI\Traits\Observable;

class Height extends Model
{
    use Filterable, Observable;

    protected $table        = 'height';
    protected $fillable     = ['structure_height', 'elevation'];

    public function aid(){
        return $this->belongsTo(Aid::class);
    }

}
