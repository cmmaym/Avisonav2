<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class NoticeLang extends Model
{
    use Filterable;
    
    protected $table        = 'notice_lang';
    protected $fillable     = ['observation'];

    public function notice(){
        return $this->belongsTo(Notice::class);
    }

    public function language(){
        return $this->belongsTo(Language::class);
    }

}
