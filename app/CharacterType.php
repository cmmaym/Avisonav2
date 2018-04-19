<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class CharacterType extends Model
{
    use Filterable;
    
    protected $table        = 'character_type';
    protected $fillable     = ['name', 'state'];

    public function language(){
        return $this->belongsTo()(Language::class);
    }

    public function CharacterType(){
        return $this->hasMany(CharacterType::class, 'parent_id', 'id');
    }

    public function parent(){
        return $this->belongsTo(CharacterType::class);
    }
}
