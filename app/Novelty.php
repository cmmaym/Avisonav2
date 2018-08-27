<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Novelty extends Model
{
    use Filterable;

    protected $table        = 'novelty';
    protected $fillable     = ['state'];

    public function notice(){
        return $this->belongsTo(Notice::Class);
    }
    
    public function noveltyType(){
        return $this->belongsTo(NoveltyType::class);
    }

    public function characterType(){
        return $this->belongsTo(CharacterType::Class);
    }

    public function symbol(){
        return $this->belongsTo(Symbol::class);
    }

    public function parent(){
        return $this->belongsTo(Novelty::class, 'parent_id', 'id');
    }

    public function coordinate(){
        return $this->belongsToMany(Coordinate::class, 'novelty_coordinate')
                    ->withTimestamps();
    }

    public function noveltyFile(){
        return $this->hasMany(NoveltyFile::class);
    }
}