<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Relations\Pivot;

class NoticeAid extends Pivot
{
    // public function aid(){

    // }

    
    // public function ayuda(){
    //     $coordenadaId = $this->coordenada_id;

    //     return $this->belongsTo(Ayuda::class)
    //                 ->with(['coordenada' => function($query) use ($coordenadaId){
    //                     $query->where('id', $coordenadaId);
    //                 }]);
    // }
}
