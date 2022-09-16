<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Aid;
use AvisoNavAPI\NoticeAid;
use AvisoNavAPI\AvisoDetalle;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use AvisoNavAPI\Traits\Observable;

class Notice extends Model
{
    use Filterable, Observable;

    protected $table        = 'notice';
    protected $fillable     = ['state'];
    protected $dates = ['report_date', 'review_date', 'publication_date', 'rn_date_user_confirm'];
    protected $casts = [
        'is_legacy' => 'boolean',
    ];

    public function novelty()
    {
        return $this->hasMany(Novelty::class);
    }
    
    public function location(){
        return $this->belongsTo(Location::class);
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

    public function user(){
        return $this->belongsTo(User::class, 'created_by', 'username');
    }

    public function reviewUser(){
        return $this->belongsTo(User::class, 'review_user', 'username');
    }

    public function rnUser(){
        return $this->belongsTo(User::class, 'rn_user', 'username');
    }
}