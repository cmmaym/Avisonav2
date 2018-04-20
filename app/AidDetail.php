<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class AidDetail extends Model
{
    use Filterable;
    
    protected   $table      =   'aid_detail';
    protected   $fillable   =   [
            'description',
            'observation',
            'state'
    ];

    public function aid(){
        return $this->belongsTo(Aid::class);
    }

    public function coordinate(){
        return $this->belongsTo(Coordinate::class);
    }

    public function lightType(){
        return $this->belongsTo(LightType::class);
    }
    
    public function colorType(){
        return $this->belongsTo(ColorType::class);
    }
    
    public function noveltyType(){
        return $this->belongsTo(NoveltyType::class);
    }

    public function language(){
        return $this->belongsTo(Language::class);
    }

    public function parent(){
        return $this->belongsTo(AidDetail::class);
    }

    public function aidDetail(){
        return $this->hasMany(AidDetail::class, 'parent_id', 'id');
    }
}
