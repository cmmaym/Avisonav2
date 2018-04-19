<?php

namespace AvisoNavAPI\Http\Controllers\NoveltyType;

use AvisoNavAPI\NoveltyType;
use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\NoveltyTypeResource;
use AvisoNavAPI\ModelFilters\Basic\NoveltyTypeFilter;
use AvisoNavAPI\Http\Requests\NoveltyType\StoreNoveltyType;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;

class NoveltyTypeChildController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NoveltyType $noveltyType)
    {        
        $collection = $noveltyType->NoveltyType()->filter(request()->all(), NoveltyTypeFilter::class)->paginateFilter($this->perPage());

        return NoveltyTypeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoveltyType $request, NoveltyType $noveltyType)
    {
        $this->validateChildLanguage($noveltyType->language_id);

        $childNoveltyType = new NoveltyType($request->only(['name','state']));
        $childNoveltyType->language_id = $request->input('language_id');
        
        $noveltyType->NoveltyType()->save($childNoveltyType);
        
        return new NoveltyTypeResource($childNoveltyType);
    }

}
