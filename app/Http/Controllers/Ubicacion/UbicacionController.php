<?php

namespace AvisoNavAPI\Http\Controllers\Ubicacion;

use AvisoNavAPI\Ubicacion;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\UbicacionResource;
use AvisoNavAPI\Http\Requests\Ubicacion\StoreUbicacion;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\UbicacionResource
     */
    public function index()
    {
        $collection = Ubicacion::all();
        
        return UbicacionResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Ubicacion\StoreUbicacion  $request
     * @return \AvisoNavAPI\Http\Resources\UbicacionResource
     */
    public function store(StoreUbicacion $request)
    {
        $ubicacion = Ubicacion::create($request->only(['ubicacion','sub_ubicacion','estado','zona_id']));

        return new UbicacionResource($ubicacion);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Ubicacion  $ubicacion
     * @return \AvisoNavAPI\Http\Resources\UbicacionResource
     */
    public function show(Ubicacion $ubicacion)
    {
        return new UbicacionResource($ubicacion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Ubicacion\StoreUbicacion  $request
     * @param  \AvisoNavAPI\Ubicacion  $ubicacion
     * @return \AvisoNavAPI\Http\Resources\UbicacionResource
     */
    public function update(StoreUbicacion $request, Ubicacion $ubicacion)
    {
        $ubicacion->fill($request->only(['ubicacion','sub_ubicacion','estado','zona_id']));

        if($ubicacion->isClean()){
            return response()->json(['error' => ['title' => 'Debe por lo menos realizar un cambio para actualizar', 'status' => 422]], 422);
        }

        $ubicacion->save();

        return new UbicacionResource($ubicacion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Ubicacion  $ubicacion
     * @return \AvisoNavAPI\Http\Resources\UbicacionResource
     */
    public function destroy(Ubicacion $ubicacion)
    {
        $ubicacion->delete();

        return new UbicacionResource($ubicacion);
    }
}
