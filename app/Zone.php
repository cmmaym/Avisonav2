<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class Zone extends Model
{
    use Filterable;
    
    protected $table        = 'zone';
    protected $fillable     = ['name', 'alias', 'state'];

    public function language(){
        return $this->belongsTo(Language::class);
    }

    public function zone(){
        return $this->hasMany(Zone::class, 'parent_id', 'id');
    }

    public function parent(){
        return $this->belongsTo(Zone::class);
    }
}