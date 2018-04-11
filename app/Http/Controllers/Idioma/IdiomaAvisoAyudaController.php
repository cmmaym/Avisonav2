<?php

namespace AvisoNavAPI\Http\Controllers\Idioma;

use AvisoNavAPI\Aviso;
use AvisoNavAPI\Idioma;
use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\AyudaResource;

class IdiomaAvisoAyudaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Idioma $idioma, Aviso $aviso)
    {
        $query = $aviso->ayudas()
                             ->whereHas('coordenada', function($q) use ($idioma){
                                $q->join('aviso_ayuda', function($q){
                                    $q->on('coordenada.ayuda_id', 'aviso_ayuda.ayuda_id')
                                      ->on('aviso_ayuda.coordenada_id', 'coordenada.id');
                                })
                                ->where('altitud', 6)
                                 ->whereHas('coordenadaDetalle', function($q) use ($idioma){
                                    $q->where('idioma_id', $idioma->id);
                                 });
                             })
                             ->with([
                                'coordenada' => function($query){
                                    $query->join('aviso_ayuda', function($q){
                                        $q->on('coordenada.ayuda_id', 'aviso_ayuda.ayuda_id')
                                        ->on('aviso_ayuda.coordenada_id', 'coordenada.id');
                                    });                                    
                                },
                                'coordenada.coordenadaDetalle' => function($query) use ($idioma){
                                    $query->where('idioma_id', $idioma->id);
                                }
                            ]);//->where('numero', 538);
             
        $collection = $query->paginate(3);
        
        return AyudaResource::collection($collection);
        
    }

}
