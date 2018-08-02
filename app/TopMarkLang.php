<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class TopMarkLang extends Model
{
    use Filterable;

    protected $table        = 'top_mark_lang';
    protected $fillable     = ['description'];

    public function language(){
        return $this->belongsto(Language::class);
    }

    public function topMark(){
        return $this->belongsTo(TopMark::class);
    }

}
