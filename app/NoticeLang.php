<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use AvisoNavAPI\Traits\Observable;

class NoticeLang extends Model
{
    use Filterable, Observable;
    
    protected $table        = 'notice_lang';
    protected $fillable     = ['description'];

    public function notice(){
        return $this->belongsTo(Notice::class);
    }

    public function language(){
        return $this->belongsTo(Language::class);
    }

}
