<?php

namespace AvisoNavAPI\Http\Controllers\Idioma;

use AvisoNavAPI\Aviso;
use AvisoNavAPI\Http\Resources\AvisoResource;
use AvisoNavAPI\Idioma;
use function foo\func;
use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;

class IdiomaAvisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Idioma $idioma
     * @return \Illuminate\Http\Response
     */
    public function index(Idioma $idioma)
    {
        $collection = $idioma->aviso()->with([
                    'avisoDetalle' => function($query) use ($idioma){
                        $query->where('idioma_id','=',$idioma->id);
                    }])->get();

        return AvisoResource::collection($collection);
    }

    /**
     * Display the specified resource.
     *
     * @param Idioma $idioma
     * @param Aviso $aviso
     * @return \Illuminate\Http\Response
     */
    public function show(Idioma $idioma, Aviso $aviso)
    {
        $entity = $idioma->aviso()->with([
            'avisoDetalle' => function($query) use ($idioma){
                $query->where('idioma_id','=',$idioma->id);
            }])
            ->findOrFail($aviso->id);

        return new AvisoResource($entity);
    }

}
