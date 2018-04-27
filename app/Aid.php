<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Notice;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Aid extends Model
{
    use Filterable;

    protected $table        = 'aid';
    protected $fillable     = ['number', 'sub_name', 'state'];

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function aidLangs(){
        return $this->hasMany(AidLang::class);
    }

    public function notice(){
        return $this->belongsToMany(Notice::class);
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

    //Obtenemos el detalle de la ayuda
    //que corresponde al aviso
    public function aidLangNotice(){
        return $this->hasOne(AidLang::class)
                    ->join('notice_aid', function($query){
                        $query->on('aid_lang.aid_id', 'notice_aid.aid_id')
                              ->on('notice_aid.coordinate_id', 'aid_lang.coordinate_id');
                    });
    }

    public function chart(){
        return $this->belongsToMany(Chart::class)
                    ->withTimestamps()
                    ->withPivot(['aid_detail_id', 'chart_edition_id']);
    }

}