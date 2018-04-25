<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class CharacterTypeLang extends Model
{
    use Filterable;

    protected $table        = 'character_type_lang';
    protected $fillable     = ['name'];

    public function language(){
        return $this->belongsTo(Language::class);
    }

    public function characterType(){
        return $this->belongsTo(CharacterType::class);
    }

}
