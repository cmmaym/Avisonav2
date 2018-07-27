<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Notice;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Aid extends Model
{
    use Filterable;

    protected $table        = 'aid';
    protected $fillable     = ['number', 'sub_name', 'elevation', 'scope', 'quantity', 'observation', 'state'];

    public function aidLangs(){
        return $this->hasMany(AidLang::class);
    }
    
    public function aidLang(){
        return $this->hasOne(AidLang::class);
    }
    
    public function aidType(){
        return $this->belongsTo(AidType::class);
    }
    
    public function location(){
        return $this->belongsTo(Location::class);
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

    public function coordinates(){
        return $this->hasMany(Coordinate::class);
    }

    public function coordinate(){
        return $this->hasOne(Coordinate::class)->orderBy('id', 'desc');
    }
    
    public function notice(){
        return $this->belongsToMany(Notice::class);
    }

    public function chart(){
        return $this->belongsToMany(Chart::class)
                    ->withTimestamps()
                    ->withPivot(['coordinate_id', 'chart_edition_id']);
    }

}
