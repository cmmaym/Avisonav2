<?php

namespace AvisoNavAPI;

use AvisoNavAPI\AvisoDetalle;
use Illuminate\Database\Eloquent\Model;

class Aviso extends Model
{
    protected $table        = 'aviso';
    protected $fillable     = [
        'num_aviso',
        'fecha',
        'periodo',
        'entidad_id',
        'user_id',
    ];

    public function entidad(){
        return $this->belongsTo(Entidad::class);
    }

    public function carta(){
        return $this->belongsToMany(Carta::class)->withTimestamps();
    }

    public function avisoDetalle(){
        return $this->hasMany(AvisoDetalle::class);
    }

    public function ayuda(){

        $id = $this->id;

        //A la ayuda le asignamos las coordenadas
        //con respecto a la version asociada con el aviso
        return $this->belongsToMany(Ayuda::class)
                    // ->withTimestamps()
                    ->withPivot('ayuda_version')
                    ->with(['coordenada' => function($q) use($id){
                        $q->select('coordenada.*');
                        $q->join('aviso_ayuda', function($join){
                            $join->on('coordenada.ayuda_id', '=', 'aviso_ayuda.ayuda_id')
                                 ->on('coordenada.version', '=', 'aviso_ayuda.ayuda_version');
                        });
                        
                        $q->where('aviso_ayuda.aviso_id', $id);
                    }]);
    }

}