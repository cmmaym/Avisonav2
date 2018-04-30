<?php

namespace AvisoNavAPI\Http\Controllers\NoveltyType;

use AvisoNavAPI\NoveltyType;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\NoveltyTypeLang;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\NoveltyType\NoveltyTypeResource;
use AvisoNavAPI\ModelFilters\Basic\NoveltyTypeFilter;
use AvisoNavAPI\Http\Resources\NoveltyType\NoveltyTypeLangResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use AvisoNavAPI\ModelFilters\Basic\NoveltyTypeLangFilter;
use AvisoNavAPI\Http\Requests\NoveltyType\StoreNoveltyType;
use AvisoNavAPI\Http\Requests\NoveltyType\UpdateNoveltyType;

class NoveltyTypeController extends Controller
{
    use Filter;
    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\NoveltyTypeLangResource
     */
    public function index()
    {        
        $collection = NoveltyTypeLang::filter(request()->all(), NoveltyTypeLangFilter::class)
                                     ->with(['noveltyType'])
                                     ->paginateFilter($this->perPage());

        return NoveltyTypeLangResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\NoveltyType\StoreNoveltyType  $request
     * @return \AvisoNavAPI\Http\Resources\NoveltyTypeResource
     */
    public function store(StoreNoveltyType $request)
    {        
        $noveltyType = new NoveltyType();
        $noveltyType->save();
        
        return new NoveltyTypeResource($noveltyType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\NoveltyType  NoveltyType
     * @return \AvisoNavAPI\Http\Resources\NoveltyTypeResource
     */
    public function show(NoveltyType $noveltyType)
    {        
        return new NoveltyTypeResource($noveltyType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\NoveltyType\StoreNoveltyType  $request
     * @param  \AvisoNavAPI\NoveltyType    NoveltyType
     * @return \AvisoNavAPI\Http\Resources\NoveltyTypeResource
     */
    public function update(StoreNoveltyType $request, NoveltyType $noveltyType)
    {        
        $noveltyType->fill($request->only(['state']));
        
        if($noveltyType->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }
        
        $noveltyType->save();

       return new NoveltyTypeResource($noveltyType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\NoveltyType    NoveltyType
     * @return \AvisoNavAPI\Http\Resources\NoveltyTypeResource
     */
    public function destroy(NoveltyType $noveltyType)
    {        
        $noveltyType->delete();

        return new NoveltyTypeResource($noveltyType);
    }
}