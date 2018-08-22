<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Novelty extends Model
{
    use Filterable;

    protected $table        = 'novelty';

    public function notice(){
        return $this->belongsTo(Notice::Class);
    }
    
    public function characterType(){
        return $this->belongsTo(CharacterType::Class);
    }
    
    public function noveltyType(){
        return $this->belongsTo(NoveltyType::class);
    }

    public function aid(){
        return $this->belongsToMany(Aid::class, 'novelty_aid')
                    ->withTimestamps()
                    ->withPivot('coordinate_id', 'chart_edition_id');
    }
}