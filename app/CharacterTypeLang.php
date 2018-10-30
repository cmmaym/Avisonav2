<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use AvisoNavAPI\Traits\Observable;

class CharacterTypeLang extends Model
{
    use Filterable, Observable;

    protected $table        = 'character_type_lang';
    protected $fillable     = ['name'];

    public function language(){
        return $this->belongsTo(Language::class);
    }

    public function characterType(){
        return $this->belongsTo(CharacterType::class);
    }

}
