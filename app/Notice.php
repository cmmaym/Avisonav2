<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Aid;
use AvisoNavAPI\NoticeAid;
use AvisoNavAPI\AvisoDetalle;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use Filterable;

    protected $table        = 'notice';
    protected $fillable     = ['number', 'state'];

    public function characterType(){
        return $this->belongsTo(CharacterType::Class);
    }
    
    public function noveltyType(){
        return $this->belongsTo(NoveltyType::class);
    }
    
    public function zone(){
        return $this->belongsTo(Zone::class);
    }
    
    public function catalogOceanCoast(){
        return $this->belongsTo(CatalogOceanCoast::class);
    }
    
    public function LightList(){
        return $this->belongsTo(LightList::class);
    }
    
    public function reportSource(){
        return $this->belongsTo(ReportSource::class);
    }
    
    public function reportingUser(){
        return $this->belongsTo(ReportingUser::class);
    }

    public function noticeLangs(){
        return $this->hasMany(NoticeLang::class);
    }

    public function noticeLang(){
        return $this->hasOne(NoticeLang::class);
    }

    public function aid(){
        return $this->belongsToMany(Aid::class, 'notice_aid')
                    ->withTimestamps()
                    ->withPivot('coordinate_id');
    }

}