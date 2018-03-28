<?php

namespace AvisoNavAPI\Http\Controllers\Aviso;

use AvisoNavAPI\Aviso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\AvisoResource;

class AvisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Aviso::with('avisoDetalle.tipoAviso')
                           ->with('carta')
                           ->get();

       return AvisoResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //     $data = DB::transaction(function () use ($request) {
    //         $collection = collect($request->input('ayuda'));

    //         $aviso = Aviso::create($request->only(['num_aviso', 'fecha', 'periodo', 'entidad_id']));            
    //         $aviso->avisoDetalle()->create($request->only(['observacion', 'tipo_aviso_id', 'tipo_caracter_id', 'idioma_id']));

    //         // //Le asignamos al registro principal los otros subregistros que tendra asociado
    //         // $collection->each(function($subItem) use ($entity){
    //         //     $entity->tipoAviso()->create($subItem);
    //         // });
            
    //         return $aviso;
    //     });
        
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function show(Aviso $aviso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \AvisoNavAPI\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aviso $aviso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aviso $aviso)
    {
        //
    }
}
