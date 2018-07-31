<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class CharacterType extends Model
{
    use Filterable;
    
    protected $table        = 'character_type';

    public function characterTypeLangs(){
        return $this->hasMany(CharacterTypeLang::class);
    }
    
    public function characterTypeLang(){
        return $this->hasOne(CharacterTypeLang::class);
    }

}
