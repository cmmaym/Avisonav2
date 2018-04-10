<?php

namespace AvisoNavAPI\Http\Controllers\Idioma;

use AvisoNavAPI\Zona;
use AvisoNavAPI\Aviso;
use function foo\func;
use AvisoNavAPI\Idioma;
use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\AvisoResource;
use AvisoNavAPI\Traits\Responser;

class IdiomaAvisoController extends Controller
{
    use Responser;
    
    /**
     * Display the specified resource.
     *
     * @param Idioma $idioma
     * @param Aviso $aviso
     * @return \Illuminate\Http\Response
     */
    public function show(Idioma $idioma, Aviso $aviso)
    {
        $aviso->load([
            'entidad',
            'avisoDetalle' => function($query) use ($idioma){
                $query->where('idioma_id', $idioma->id);
            },
            'ayudas.ubicacion.zona' => function($query) use ($idioma){
                $query->where('idioma_id', $idioma->id);
            },
            'carta'
        ]);

        $aviso->ayudas->each(function($ayuda) use ($idioma){
            $ayuda->pivot->ayuda->coordenada->load(['coordenadaDetalle' => function($query) use ($idioma){
                $query->where('idioma_id', $idioma->id);
            }]);
        });

        return new AvisoResource($aviso);
    }
}
