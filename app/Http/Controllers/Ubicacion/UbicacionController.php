<?php

namespace AvisoNavAPI\Http\Controllers\Ubicacion;

use AvisoNavAPI\Ubicacion;
use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\UbicacionResource;
use AvisoNavAPI\Http\Requests\Ubicacion\StoreUbicacion;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ubicacion = Ubicacion::all();
        
        return UbicacionResource::collection($ubicacion);
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
    public function store(StoreUbicacion $request)
    {
        $ubicacion = Ubicacion::create($request->all());

        return new UbicacionResource($ubicacion);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function show(Ubicacion $ubicacion)
    {
        return new UbicacionResource($ubicacion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \AvisoNavAPI\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Ubicacion $ubicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \AvisoNavAPI\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUbicacion $request, Ubicacion $ubicacion)
    {
        $ubicacion->fill($request->only([
            'ubicacion',
            'sub_ubicacion',
            'estado',
            'zona_id',
        ]));

        if($ubicacion->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }

        $ubicacion->save();

        return new UbicacionResource($ubicacion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ubicacion $ubicacion)
    {
        $ubicacion->delete();

        return new UbicacionResource($ubicacion);
    }
}
