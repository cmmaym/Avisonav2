<?php

namespace AvisoNavAPI\Http\Controllers\NoveltyType;

use AvisoNavAPI\Language;
use AvisoNavAPI\NoveltyType;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\NoveltyTypeLang;
use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\ModelFilters\Basic\NoveltyTypeFilter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use AvisoNavAPI\ModelFilters\Basic\NoveltyTypeLangFilter;
use AvisoNavAPI\Http\Requests\NoveltyType\StoreNoveltyType;
use AvisoNavAPI\Http\Requests\NoveltyType\UpdateNoveltyType;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\NoveltyType\NoveltyTypeResource;
use AvisoNavAPI\Http\Resources\NoveltyType\NoveltyTypeLangResource;

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
                                     ->orderBy('is_legacy', 'asc')
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
        $language = Language::where('code','es')->firstOrFail();
        
        $noveltyType = new NoveltyType();
        $noveltyType->save();
        
        $noveltyTypeLang = new NoveltyTypeLang();
        $noveltyTypeLang->name = $request->input('name'); 
        $noveltyTypeLang->description = ($request->input('description')) ? $request->input('description') : null;
        $noveltyTypeLang->language_id = $language->id; 
        
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