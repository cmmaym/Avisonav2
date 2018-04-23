<?php

namespace AvisoNavAPI;

use AvisoNavAPI\Notice;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Aid extends Model
{
    use Filterable;

    protected $table        = 'aid';
    protected $fillable     = [
        'number',
        'sub_name',
        'state'
    ];

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function aidDetail(){
        return $this->hasMany(AidDetail::class);
    }

    public function notice(){
        return $this->belongsToMany(Notice::class);
    }

    //Obtenemos el detalle de la ayuda
    //que corresponde al aviso
    public function aidDetailNotice(){
        return $this->hasOne(AidDetail::class)
                    ->join('notice_aid', function($query){
                        $query->on('aid_detail.aid_id', 'notice_aid.aid_id')
                              ->on('notice_aid.aid_detail_id', 'aid_detail.id');
                    });
    }

    public function chart(){
        return $this->belongsToMany(Chart::class)
                    ->withTimestamps()
                    ->withPivot(['aid_detail_id', 'chart_edition_id']);
    }

}
