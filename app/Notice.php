<?php

namespace AvisoNavAPI;

use AvisoNavAPI\AvisoDetalle;
use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class Notice extends Model
{
    use Filterable;

    protected $table        = 'notice';
    protected $fillable     = ['number', 'date'];

    public function entity(){
        return $this->belongsTo(Entity::class);
    }

    public function noticeDetail(){
        return $this->hasMany(NoticeDetail::class);
    }

    // public function ayudas(){

    //     $id = $this->id;

    //     //A la ayuda le asignamos las coordenadas
    //     //con respecto a la version asociada con el aviso
    //     return $this->belongsToMany(Ayuda::class)
    //                 ->withTimestamps()
    //                 ->withPivot('coordenada_id')
    //                 ->using(AvisoAyuda::class);
    // }
}