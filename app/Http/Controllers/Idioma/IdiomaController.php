<?php

namespace AvisoNavAPI\Http\Controllers\Idioma;

use Validator;
use AvisoNavAPI\Idioma;
use Illuminate\Http\Request;
use AvisoNavAPI\Http\Requests\Idioma\StoreIdioma;
use AvisoNavAPI\Http\Requests\Idioma\UpdateIdioma;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\IdiomaResource;

class IdiomaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idiomas = Idioma::all();
        
        return IdiomaResource::collection($idiomas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIdioma $request)
    {
        $idioma = Idioma::create($request->all());

        return new IdiomaResource($idioma);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Idioma  $idioma
     * @return \Illuminate\Http\Response
     */
    public function show(Idioma $idioma)
    {
        return new IdiomaResource($idioma);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \AvisoNavAPI\Idioma  $idioma
     * @return \Illuminate\Http\Response
     */
    public function edit(Idioma $idioma)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \AvisoNavAPI\Idioma  $idioma
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIdioma $request, Idioma $idioma)
    {
        $idioma->fill($request->only([
            'nombre',
            'alias',
            'estado',
        ]));

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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Idioma $idioma)
    {
        $idioma->delete();

        return new IdiomaResource($idioma);
    }
}