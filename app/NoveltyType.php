<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class NoveltyType extends Model
{
    use Filterable;

    protected $table        = 'novelty_type';
    protected $fillable     = ['state'];
    
    public function noveltyTypeLangs(){
        return $this->hasMany(NoveltyTypeLang::class);
    }
    
    public function noveltyTypeLang(){
        return $this->hasOne(NoveltyTypeLang::class);
    }

}
