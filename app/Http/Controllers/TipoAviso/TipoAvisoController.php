<?php

namespace AvisoNavAPI\Http\Controllers\TipoAviso;

use AvisoNavAPI\TipoAviso;
use Illuminate\Http\Request;
use AvisoNavAPI\Consecutivo;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\TipoAvisoResource;
use AvisoNavAPI\Http\Requests\TipoAviso\StoreTipoAviso;

class TipoAvisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposAviso = TipoAviso::all();

        return TipoAvisoResource::collection($tiposAviso);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoAviso $request)
    {
        //$tipoAviso = TipoAviso::create($request->all());
        DB::transaction(function () use ($request) {
            $consecutivo = Consecutivo::where('nombre', 'tipo_aviso')->first();            
            $tipoAviso = new TipoAviso();
    
            $tipoAviso->cod_ide = $consecutivo->numero;
            $tipoAviso->nombre = $request->get('nombre');
            $tipoAviso->estado = $request->get('estado');
            $tipoAviso->idioma_id = $request->get('idioma_id');
    
            $consecutivo->numero = $consecutivo->numero + 1;
            $consecutivo->save();

            $tipoAviso->save();
    
            //dd($tipoAviso);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\TipoAviso  $tipoAviso
     * @return \Illuminate\Http\Response
     */
    public function show(TipoAviso $tipoAviso)
    {
        return new TipoAvisoResource($tipoAviso);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \AvisoNavAPI\TipoAviso  $tipoAviso
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoAviso $tipoAviso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \AvisoNavAPI\TipoAviso  $tipoAviso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoAviso $tipoAviso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\TipoAviso  $tipoAviso
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoAviso $tipoAviso)
    {
        //
    }
}
