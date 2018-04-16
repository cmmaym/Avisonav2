<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class NoticeType extends Model
{
    protected $table        = 'notice_type';
    protected $fillable     = ['name', 'state'];

    public function language(){
        return $this->belongsTo(Language::class);
    }
    
    public function noticeType(){
        return $this->hasMany(NoticeType::class, 'parent_id', 'id');
    }

    public function parent(){
        return $this->belongsTo(NoticeType::class, 'parent_id', 'id');
    }
}
