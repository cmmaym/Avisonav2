<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use AvisoNavAPI\Traits\Observable;

class NoveltyTypeLang extends Model
{
    use Filterable, Observable;

    protected $table        = 'novelty_type_lang';
    protected $fillable     = ['name'];

    public function language(){
        return $this->belongsTo(Language::class);
    }

    public function noveltyType(){
        return $this->belongsTo(NoveltyType::class);
    }

}
