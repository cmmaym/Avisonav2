<?php

namespace AvisoNavAPI\Http\Controllers\TipoAviso;

use AvisoNavAPI\TipoAviso;
use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\TipoAvisoResource;

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\TipoAviso  $tipoAviso
     * @return \Illuminate\Http\Response
     */
    public function show(TipoAviso $tipoAviso)
    {
        //return TipoAviso::has('idioma')->get();
       
        //return $tipoAviso->idioma()->get();

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
