<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use AvisoNavAPI\Traits\Observable;

class SymbolNovelty extends Model
{
    use Filterable, Observable;

    protected $table        = 'symbol_novelty';
    protected $casts = [
        'is_light_properties_visible' => 'boolean',
    ];

    public function novelty(){
        return $this->belongsTo(Novelty::class);
    }
    
    public function symbol(){
        return $this->belongsTo(Symbol::class);
    }
    
    public function height(){
        return $this->belongsTo(Height::class);
    }
    
    public function nominalScope(){
        return $this->belongsTo(NominalScope::class);
    }
    
    public function period(){
        return $this->belongsTo(Period::class);
    }

}