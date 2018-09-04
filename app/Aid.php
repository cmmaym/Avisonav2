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

    public function sequenceFlashes(){
        return $this->hasMany(SequenceFlashes::class);
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

}
