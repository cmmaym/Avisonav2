<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use AvisoNavAPI\Traits\Observable;
class CharacterType extends Model
{
    use Filterable, Observable;
    
    protected $table        = 'character_type';
    protected $fillable     = ['alias'];

    public function characterTypeLangs(){
        return $this->hasMany(CharacterTypeLang::class);
    }
    
    public function characterTypeLang(){
        return $this->hasOne(CharacterTypeLang::class);
    }

}
