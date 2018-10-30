<?php

namespace AvisoNavAPI\Http\Controllers\LightList;

use AvisoNavAPI\LightList;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\ModelFilters\Basic\LightListFilter;
use AvisoNavAPI\Http\Resources\LightListResource;
use AvisoNavAPI\Http\Requests\LightList\StoreLightList;
use AvisoNavAPI\Traits\Responser;

class LightListController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = LightList::filter(request()->all(), LightListFilter::class)
                            ->paginateFilter($this->perPage());

        return LightListResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLightList $request)
    {
        $lightList = new LightList($request->only(['edition', 'year']));
        $lightList->save();

        return new LightListResource($lightList);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(LightList $lightList)
    {
        return new LightListResource($lightList);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLightList $request, LightList $lightList)
    {
        $lightList->fill($request->only(['edition', 'year']));
        $lightList->save();

        return new LightListResource($lightList);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LightList $lightList)
    {
        $lightList->delete();

        return new LightListResource($lightList);
    }
}
