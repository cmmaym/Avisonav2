<?php

namespace AvisoNavAPI\Http\Controllers\TopMark;

use AvisoNavAPI\TopMark;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\ModelFilters\Basic\TopMarkFilter;
use AvisoNavAPI\Http\Resources\TopMark\TopMarkLangResource;
use AvisoNavAPI\Http\Requests\TopMark\StoreTopMarkLang;
use AvisoNavAPI\ModelFilters\Basic\TopMarkLangFilter;
use AvisoNavAPI\TopMarkLang;
use AvisoNavAPI\Traits\Responser;

class TopMarkLangController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\TopMarkLangResource
     */
    public function index(TopMark $topMark)
    {
        $collection = $topMark->topMarkLangs()->filter(request()->all(), TopMarkLangFilter::class)
                                                  ->with(['topMark'])
                                                  ->paginateFilter($this->perPage());

        return TopMarkLangResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\TopMark\StoreTopMarkLang  $request
     * @return \AvisoNavAPI\Http\Resources\TopMarkLangResource
     */
    public function store(StoreTopMarkLang $request, TopMark $topMark)
    {
        $topMarkLang = new TopMarkLang($request->only(['description']));
        $topMarkLang->language_id = $request->input('language');

        $topMark->TopMarkLangs()->save($topMarkLang);

        return new TopMarkLangResource($topMarkLang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\TopMark $topMark
     * @param  \AvisoNavAPI\TopMarkLang $topMarkLang
     * @return \AvisoNavAPI\Http\ResourcesTopMarkResource
     */
    public function show(TopMark $topMark, TopMarkLang $topMarkLang)
    {
        return new TopMarkLangResource($topMarkLang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\TopMark\StoreTopMarkLang  $request
     * @param  \AvisoNavAPI\TopMark $topMark
     * @param  \AvisoNavAPI\TopMarkLang tTopMarkLang
     * @return \AvisoNavAPI\Http\Resources\TopMarkLangResource
     */
    public function update(StoreTopMarkLang $request, TopMark $topMark, TopMarkLang $topMarkLang)
    {
        $topMarkLang->fill($request->only(['description']));
        $topMarkLang->language_id = $request->input('language');
        
        if($topMarkLang->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        }

        $topMarkLang->save();

        return new TopMarkLangResource($topMarkLang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\TopMark $topMark
     * @param  \AvisoNavAPI\TopMarkLang $topMarkLang
     * @return \AvisoNavAPI\Http\Resources\TopMarkLangResource
     */
    public function destroy(TopMark $topMark, TopMarkLang $topMarkLang)
    {
        $topMarkLang->delete();

        return new TopMarkLangResource($topMarkLang);
    }

}
