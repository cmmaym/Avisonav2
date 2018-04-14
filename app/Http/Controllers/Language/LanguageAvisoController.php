<?php

namespace AvisoNavAPI\Http\Controllers\Language;

use AvisoNavAPI\Zona;
use AvisoNavAPI\Aviso;
use AvisoNavAPI\Language;
use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\AvisoResource;
use AvisoNavAPI\Traits\Responser;

class LanguageAvisoController extends Controller
{
    use Responser;
    
    /**
     * Display the specified resource.
     *
     * @param Language $language
     * @param Aviso $aviso
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language, Aviso $aviso)
    {
        $aviso->load([
            'entidad',
            'avisoDetalle' => function($query) use ($language){
                $query->where('language_id', $language->id);
            },
            'ayudas.ubicacion.zona' => function($query) use ($language){
                $query->where('language_id', $language->id);
            },
            'carta',
            'ayudas.coordenada' => function($query){
                $query->join('aviso_ayuda', function($q){
                    $q->on('coordenada.ayuda_id', 'aviso_ayuda.ayuda_id')
                      ->on('aviso_ayuda.coordenada_id', 'coordenada.id');
                });
            },
            'ayudas.coordenada.coordenadaDetalle' => function($query) use ($language){
                $query->where('language_id', $language->id);
            }
        ]);

        return new AvisoResource($aviso);
    }
}
