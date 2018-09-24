<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use AvisoNavAPI\Traits\Observable;

class NoveltyLang extends Model
{
    use Filterable, Observable;
    
    protected $table        = 'novelty_lang';
    protected $fillable     = ['name'];

    public function novelty(){
        return $this->belongsTo(Novelty::class);
    }

    public function language(){
        return $this->belongsTo(Language::class);
    }

}
