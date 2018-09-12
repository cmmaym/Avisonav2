<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class SymbolNovelty extends Model
{
    use Filterable;

    protected $table        = 'symbol_novelty';

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