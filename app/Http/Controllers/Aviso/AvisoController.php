<?php

namespace AvisoNavAPI\Http\Controllers\Aviso;

use AvisoNavAPI\Aviso;
use AvisoNavAPI\Http\Resources\AvisoResource;
use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;

class AvisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Aviso::where('idioma_id', 2)
                            ->with('tipoAviso.idioma')
                            //->where('idioma_id', 2)
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
        //
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
