<?php

namespace AvisoNavAPI\Http\Controllers\NoveltyType;

use AvisoNavAPI\NoveltyType;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\NoveltyTypeLang;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\NoveltyTypeLangResource;
use AvisoNavAPI\ModelFilters\Basic\NoveltyTypeLangFilter;
use AvisoNavAPI\Http\Requests\NoveltyType\StoreNoveltyTypeLang;

class NoveltyTypeLangController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NoveltyType $noveltyType)
    {        
        $collection = $noveltyType->noveltyTypeLangs()->filter(request()->all(), NoveltyTypeLangFilter::class)
                                                     ->with(['noveltyType'])
                                                     ->paginateFilter($this->perPage());

        return NoveltyTypeLangResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\NoveltyType\StoreNoveltyTypeLang  $request
     * @param  \AvisoNavAPI\NoveltyType
     * @return \AvisoNavAPI\Http\Resources\NoveltyTypeLangResource
     */
    public function store(StoreNoveltyTypeLang $request, NoveltyType $noveltyType)
    {
        $noveltyTypeLang = new NoveltyTypeLang($request->only(['name']));
        $noveltyTypeLang->language_id = $request->input('language_id');

        $noveltyType->noveltyTypeLangs()->save($noveltyTypeLang);

        return new NoveltyTypeLangResource($noveltyTypeLang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\NoveltyType  NoveltyType
     * @param  \AvisoNavAPI\NoveltyTypeLang  NoveltyTypeLang
     * @return \AvisoNavAPI\Http\Resources\NoveltyTypeResource
     */
    public function show(NoveltyType $noveltyType, NoveltyTypeLang $noveltyTypeLang)
    {        
        return new NoveltyTypeLangResource($noveltyTypeLang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\NoveltyType\StoreNoveltyTypeLang  $request
     * @param  \AvisoNavAPI\NoveltyType    NoveltyType
     * @param  \AvisoNavAPI\NoveltyTypeLang    NoveltyTypeLang
     * @return \AvisoNavAPI\Http\Resources\NoveltyTypeLangResource
     */
    public function update(StoreNoveltyTypeLang $request, NoveltyType $noveltyType, NoveltyTypeLang $noveltyTypeLang)
    {        
        $noveltyTypeLang->fill($request->only(['name']));
        
        if($noveltyTypeLang->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }
        
        $noveltyTypeLang->save();

       return new NoveltyTypeLangResource($noveltyTypeLang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\NoveltyType    NoveltyType
     * @param  \AvisoNavAPI\NoveltyTypeLang    NoveltyTypeLang
     * @return \AvisoNavAPI\Http\Resources\NoveltyTypeResource
     */
    public function destroy(NoveltyType $noveltyType, NoveltyTypeLang $noveltyTypeLang)
    {        
        $noveltyTypeLang->delete();

        return new NoveltyTypeLangResource($noveltyTypeLang);
    }

}
