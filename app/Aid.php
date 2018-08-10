<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Notice;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Aid extends Model
{
    use Filterable;

    protected $table        = 'aid';
    protected $fillable     = ['ais', 'height', 'scope', 'features'];

    public function location(){
        return $this->belongsTo(Location::class);
    }
    
    public function lightClass(){
        return $this->belongsTo(LightClass::class);
    }
    
    public function colorStructurePattern(){
        return $this->belongsTo(ColorStructure::class);
    }
    
    public function topMark(){
        return $this->belongsTo(TopMark::class);
    }
    
    public function aidType(){
        return $this->belongsTo(AidType::class);
    }
    
    public function aidTypeForm(){
        return $this->belongsTo(AidTypeForm::class);
    }

    public function aidLangs(){
        return $this->hasMany(AidLang::class);
    }
    
    public function aidLang(){
        return $this->hasOne(AidLang::class);
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

    public function aidColorStructure(){
        return $this->belongsToMany(ColorStructure::class)
                    ->withTimestamps();
    }
    
    public function aidColorLight(){
        return $this->belongsToMany(ColorLight::class)
                    ->withTimestamps();
    }
    
    public function chart(){
        return $this->belongsToMany(Chart::class)
                    ->withTimestamps();
    }

}
