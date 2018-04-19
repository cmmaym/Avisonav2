<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class NoticeDetail extends Model
{
    protected $table        = 'notice_detail';
    protected $fillable     = ['observation', 'state'];

    public function notice(){
        return $this->belongsTo(Notice::class);
    }

    public function language(){
        return $this->belongsTo(Language::class);
    }

}
