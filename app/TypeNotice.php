<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class TypeNotice extends Model
{
    protected $table        = 'type_notice';
    protected $fillable     = ['name', 'state'];

    public function language(){
        return $this->belongsTo(Language::class);
    }
    
    public function typeNotice(){
        return $this->hasMany(TypeNotice::class, 'parent_id', 'id');
    }

    public function parent(){
        return $this->belongsTo(TypeNotice::class, 'parent_id', 'id');
    }
}
