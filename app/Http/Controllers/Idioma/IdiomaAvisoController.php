<?php

namespace AvisoNavAPI\Http\Controllers\Idioma;

use AvisoNavAPI\Zona;
use AvisoNavAPI\Aviso;
use function foo\func;
use AvisoNavAPI\Idioma;
use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\AvisoResource;

class IdiomaAvisoController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Idioma $idioma
     * @param Aviso $aviso
     * @return \Illuminate\Http\Response
     */
    public function show(Idioma $idioma, Aviso $aviso)
    {
        $aviso = $idioma->aviso()
                        ->with(['avisoDetalle' => function ($query) use ($idioma){
                            $query->where('idioma_id', $idioma->id);
                        }])
                        ->findOrFail($aviso->id);
        
        $aviso->ayuda->each(function($ayuda) use ($idioma){
            $coordenada_id = $ayuda->pivot->coordenada_id;
            $ubicacion = $ayuda->ubicacion;
            $ayuda->ubicacion->zona = (new Zona)->newQuery()
                                    ->where(function($query) use ($ubicacion){
                                        $query->orWhere('parent_id', $ubicacion->zona_id)
                                              ->orWhere('id', $ubicacion->zona_id);
                                    })
                                    ->where('idioma_id', $idioma->id)->first();
                                    
            $ayuda->load(
                [
                    'coordenada' => function($query) use ($coordenada_id, $idioma){
                        $query->where('id', $coordenada_id);
                        $query->with(['coordenadaDetalle' => function ($query) use ($idioma){
                            $query->where('idioma_id',$idioma->id);
                        }]);
                    }
                ]);
        });

        return new AvisoResource($aviso);
    }

}
