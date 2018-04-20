<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Aid;
use AvisoNavAPI\NoticeAid;
use AvisoNavAPI\AvisoDetalle;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use Filterable;

    protected $table        = 'notice';
    protected $fillable     = ['number', 'date', 'state'];

    public function entity(){
        return $this->belongsTo(Entity::class);
    }

    public function noticeDetail(){
        return $this->hasMany(NoticeDetail::class);
    }

    public function aid(){
        return $this->belongsToMany(Aid::class, 'notice_aid')
                    ->withTimestamps()
                    ->withPivot('aid_detail_id')
                    ->using(NoticeAid::class);
    }

}