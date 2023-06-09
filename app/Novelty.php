<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use AvisoNavAPI\Traits\Observable;

class Novelty extends Model
{
    use Filterable, Observable, SpatialTrait;

    protected $table        = 'novelty';
    protected $fillable     = ['state'];
    protected $spatialFields = [
        'spatial_data'
    ];

    public function notice(){
        return $this->belongsTo(Notice::Class);
    }

    public function noveltyLangs(){
        return $this->hasMany(NoveltyLang::class);
    }

    public function noveltyLang(){
        return $this->hasOne(NoveltyLang::class);
    }
    
    public function noveltyType(){
        return $this->belongsTo(NoveltyType::class);
    }

    public function characterType(){
        return $this->belongsTo(CharacterType::Class);
    }

    public function symbol(){
        return $this->hasOne(SymbolNovelty::class);
    }

    public function parent(){
        return $this->belongsTo(Novelty::class, 'parent_id', 'id');
    }
    
    public function child(){
        return $this->belongsTo(Novelty::class, 'id', 'parent_id');
    }

    public function coordinate(){
        return $this->belongsToMany(Coordinate::class, 'novelty_coordinate')
                    ->withTimestamps();
    }

    public function chartEdition(){
        return $this->belongsToMany(ChartEdition::class, 'novelty_chart_edition')
                    ->withTimestamps();
    }

    public function noveltyFile(){
        return $this->hasMany(NoveltyFile::class);
    }
}