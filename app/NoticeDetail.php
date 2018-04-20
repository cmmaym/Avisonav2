<?php

namespace AvisoNavAPI;

use AvisoNavAPI\CharacterType;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class NoticeDetail extends Model
{
    use Filterable;
    
    protected $table        = 'notice_detail';
    protected $fillable     = ['observation', 'state'];

    public function notice(){
        return $this->belongsTo(Notice::class);
    }

    public function characterType(){
        return $this->belongsTo(CharacterType::Class);
    }

    public function language(){
        return $this->belongsTo(Language::class);
    }

}
