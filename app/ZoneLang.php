<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use AvisoNavAPI\Traits\Observable;

class ZoneLang extends Model
{
    use Filterable, Observable;
    
    protected $table        = 'zone_lang';
    protected $fillable     = ['name', 'alias'];

    public function language(){
        return $this->belongsTo(Language::class);
    }

    public function zone(){
        return $this->belongsto(Zone::class);
    }
}
