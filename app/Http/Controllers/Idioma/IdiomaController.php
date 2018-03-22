<?php

namespace AvisoNavAPI\Http\Controllers\Idioma;

use AvisoNavAPI\Idioma;
use Illuminate\Http\Request;
use AvisoNavAPI\Http\Requests\Idioma\StoreIdioma;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\IdiomaResource;

class IdiomaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AvisoNavAPI\Http\Resources\IdiomaResource
     */
    public function index()
    {
        $collection = Idioma::all();
        
        return IdiomaResource::collection($collection);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  AvisoNavAPI\Http\Requests\Idioma\StoreIdioma  $request
     * @return AvisoNavAPI\Http\Resources\IdiomaResource
     */
    public function store(StoreIdioma $request)
    {
        $idioma = Idioma::create($request->only(['nombre','alias','estado']));

        return new IdiomaResource($idioma);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Idioma  $idioma
     * @return AvisoNavAPI\Http\Resources\IdiomaResource
     */
    public function show(Idioma $idioma)
    {
        return new IdiomaResource($idioma);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AvisoNavAPI\Http\Requests\Idioma\StoreIdioma  $request
     * @param  \AvisoNavAPI\Idioma  $idioma
     * @return AvisoNavAPI\Http\Resources\IdiomaResource
     */
    public function update(StoreIdioma $request, Idioma $idioma)
    {
        $idioma->fill($request->only(['nombre','alias','estado']));

        if($idioma->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }

        $idioma->save();

        return new IdiomaResource($idioma);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Idioma  $idioma
     * @return AvisoNavAPI\Http\Resources\IdiomaResource
     */
    public function destroy(Idioma $idioma)
    {
        $idioma->delete();

        return new IdiomaResource($idioma);
    }
}
