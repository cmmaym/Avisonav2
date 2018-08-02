<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class TopMark extends Model
{
    use Filterable;
    
    protected $table        = 'top_mark';

    public function topMarkLangs()
    {
        return $this->hasMany(TopMarkLang::class);
    }
    
    public function topMarkLang()
    {
        return $this->hasOne(TopMarkLang::class);
    }

}