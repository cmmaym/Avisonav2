<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use AvisoNavAPI\Traits\Observable;

class NoveltyType extends Model
{
    use Filterable, Observable;

    protected $table        = 'novelty_type';
    protected $casts = [
        'is_legacy' => 'boolean',
    ];
    
    public function noveltyTypeLangs(){
        return $this->hasMany(NoveltyTypeLang::class);
    }
    
    public function noveltyTypeLang(){
        return $this->hasOne(NoveltyTypeLang::class);
    }

}
