<?php

namespace AvisoNavAPI;

use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    protected $table        = 'idioma';
    protected $fillable     = ['nombre', 'alias', 'estado'];

    //Este metodo nos permite obtener todos los avisos
    //en base al idioma dado atravez de la tabla avisoDetalle
    //usando la ralacion hasManyTrhough que nos provee eloquent
    public function aviso(){
        return $this->hasManyThrough(Aviso::class,
                                    AvisoDetalle::class,
                                    'idioma_id',
                                    'id',
                                    'id',
                                    'aviso_id'
                );
    }

}
