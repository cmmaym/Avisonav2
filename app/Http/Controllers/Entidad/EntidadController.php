<?php

namespace AvisoNavAPI\Http\Controllers\Entidad;

use AvisoNavAPI\Entidad;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\EntidadResource;
use AvisoNavAPI\Http\Requests\Entidad\StoreEntidad;

class EntidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\EntidadResource
     */
    public function index()
    {
        $collection  =   Entidad::all();

        return EntidadResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Entidad\StoreEntidad  $request
     * @return \AvisoNavAPI\Http\Resources\EntidadResource
     */
    public function store(StoreEntidad $request)
    {
        $entidad = Entidad::create($request->only(['nombre','alias','estado']));

        return new EntidadResource($entidad);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Entidad  $entidad
     * @return \AvisoNavAPI\Http\Resources\EntidadResource
     */
    public function show(Entidad $entidad)
    {
        return new EntidadResource($entidad);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Entidad\StoreEntidad  $request
     * @param  \AvisoNavAPI\Entidad  $entidad
     * @return \AvisoNavAPI\Http\Resources\EntidadResource
     */
    public function update(StoreEntidad $request, Entidad $entidad)
    {
        $entidad->fill($request->only(['nombre','alias','estado',]));
        
        if($entidad->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }
        
        $entidad->save();
        
        return new EntidadResource($entidad);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Entidad  $entidad
     * @return \AvisoNavAPI\Http\Resources\EntidadResource
     */
    public function destroy(Entidad $entidad)
    {
        $entidad->delete();

        return new EntidadResource($entidad);
    }
}
