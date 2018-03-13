<?php

namespace AvisoNavAPI\Http\Controllers\Entidad;

use AvisoNavAPI\Entidad;
use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\EntidadResource;
use AvisoNavAPI\Http\Requests\Entidad\StoreEntidad;
use AvisoNavAPI\Http\Requests\Entidad\UpdateEntidad;

class EntidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entidades  =   Entidad::all();

        return EntidadResource::collection($entidades);
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
    public function store(StoreEntidad $request)
    {
        $entidad = Entidad::create($request->all());

        return new EntidadResource($entidad);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Entidad  $entidad
     * @return \Illuminate\Http\Response
     */
    public function show(Entidad $entidad)
    {
        return new EntidadResource($entidad);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \AvisoNavAPI\Entidad  $entidad
     * @return \Illuminate\Http\Response
     */
    public function edit(Entidad $entidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \AvisoNavAPI\Entidad  $entidad
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEntidad $request, Entidad $entidad)
    {
        $entidad->fill($request->only([
            'nombre',
            'alias',
            'estado',
        ]));
        
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
     * 
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entidad $entidad)
    {
        $entidad->delete();

        return new EntidadResource($entidad);
    }
}
