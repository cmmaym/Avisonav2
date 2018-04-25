<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class AidLang extends Model
{
    use Filterable;
    
    protected   $table      =   'aid_lang';
    protected   $fillable   =   ['description', 'observation'];

    public function aid(){
        return $this->belongsTo(Aid::class);
    }

    public function coordinate(){
        return $this->belongsTo(Coordinate::class);
    }

    public function language(){
        return $this->belongsTo(Language::class);
    }

}
