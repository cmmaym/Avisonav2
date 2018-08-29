<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class NoveltyLang extends Model
{
    use Filterable;
    
    protected $table        = 'novelty_lang';
    protected $fillable     = ['description'];

    public function novelty(){
        return $this->belongsTo(Novelty::class);
    }

    public function language(){
        return $this->belongsTo(Language::class);
    }

}
