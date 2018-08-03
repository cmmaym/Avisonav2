<?php

namespace AvisoNavAPI\Http\Controllers\NoveltyType;

use AvisoNavAPI\NoveltyType;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\NoveltyTypeLang;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\NoveltyType\NoveltyTypeResource;
use AvisoNavAPI\ModelFilters\Basic\NoveltyTypeFilter;
use AvisoNavAPI\Http\Resources\NoveltyType\NoveltyTypeLangResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use AvisoNavAPI\ModelFilters\Basic\NoveltyTypeLangFilter;
use AvisoNavAPI\Http\Requests\NoveltyType\StoreNoveltyType;
use AvisoNavAPI\Http\Requests\NoveltyType\UpdateNoveltyType;
use AvisoNavAPI\Traits\Responser;

class NoveltyTypeController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\NoveltyTypeLangResource
     */
    public function index()
    {
        $collection = NoveltyType::filter(request()->all(), NoveltyTypeFilter::class)
                                     ->with([
                                         'noveltyTypeLang' => $this->withLanguageQuery()
                                     ])
                                     ->paginateFilter($this->perPage());

        return NoveltyTypeResource::collection($collection);
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
        
        $noveltyTypeLang = new NoveltyTypeLang();
        $noveltyTypeLang->name = $request->input('name'); 
        $noveltyTypeLang->language_id = $request->input('language'); 
        
        $noveltyType->noveltyTypeLang()->save($noveltyTypeLang);
        
        $noveltyType->refresh();

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
        $noveltyType->load([
            'noveltyTypeLang' => $this->withLanguageQuery()
        ]);

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