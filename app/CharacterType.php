<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class CharacterType extends Model
{
    use Filterable;
    
    protected $table        = 'character_type';
    protected $fillable     = ['state'];

    public function characterTypeLangs(){
        return $this->hasMany(CharacterTypeLang::class);
    }

}
