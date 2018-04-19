<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class NoveltyType extends Model
{
    use Filterable;

    protected $table        = 'novelty_type';
    protected $fillable     = ['name', 'state'];

    public function language(){
        return $this->belongsTo(Language::class);
    }
    
    public function noveltyType(){
        return $this->hasMany(NoveltyType::class, 'parent_id', 'id');
    }

    public function parent(){
        return $this->belongsTo(NoveltyType::class, 'parent_id', 'id');
    }
}
