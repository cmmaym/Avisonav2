<?php

namespace AvisoNavAPI;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use AvisoNavAPI\Traits\Observable;

class Aid extends Model
{
    use Filterable, Observable;

    protected $table        = 'aid';
    protected $fillable     = ['racon', 'ais', 'radar_reflector', 'float_diameter'];
    
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

    public function aidColorStructure(){
        return $this->belongsToMany(ColorStructure::class)
                    ->withTimestamps();
    }
    
    public function aidColorLight(){
        return $this->belongsToMany(ColorLight::class, 'aid_color_light')
                    ->withTimestamps()
                    ->withPivot('angle');
    }

    public function symbol(){
        return $this->belongsTo(Symbol::class);
    }

    public function heightCollection()
    {
        return $this->hasMany(Height::class)->orderBy('created_at', 'desc');
    }
    
    public function height()
    {
        return $this->hasOne(Height::class)->where('state', 'C');
    }

    public function nominalScopeCollection()
    {
        return $this->hasMany(NominalScope::class)->orderBy('created_at', 'desc');
    }

    public function nominalScope()
    {
        return $this->hasOne(NominalScope::class)->where('state', 'C');
    }
    
    public function periodCollection()
    {
        return $this->hasMany(Period::class)->orderBy('created_at', 'desc');
    }

    public function period()
    {
        return $this->hasOne(Period::class)->where('state', 'C');
    }

}
