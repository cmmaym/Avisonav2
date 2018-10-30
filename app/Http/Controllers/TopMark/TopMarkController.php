<?php

namespace AvisoNavAPI\Http\Controllers\TopMark;

use AvisoNavAPI\TopMark;
use AvisoNavAPI\Language;
use AvisoNavAPI\TopMarkLang;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\ModelFilters\Basic\TopMarkFilter;
use AvisoNavAPI\Http\Requests\TopMark\StoreTopMark;
use AvisoNavAPI\ModelFilters\Basic\TopMarkLangFilter;
use AvisoNavAPI\Http\Resources\TopMark\TopMarkResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

class TopMarkController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\TopMarkResource
     */
    public function index()
    {
        $collection = TopMark::filter(request()->all(), TopMarkFilter::class)
                                   ->with([
                                       'topMarkLang' => $this->withLanguageQuery()
                                    ]) 
                                   ->paginateFilter($this->perPage());

        return TopMarkResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\TopMark\StoreTopMark  $request
     * @return \AvisoNavAPI\Http\Resources\TopMarkResource
     */
    public function store(StoreTopMark $request)
    {
        $language = Language::where('code','es')->firstOrFail();
        
        $topMark = new TopMark();
        $topMark->save();

        $topMarkLang = new TopMarkLang($request->only(['description']));
        $topMarkLang->language_id = $language->id;

        $topMark->topMarkLang()->save($topMarkLang);
        
        return new TopMarkResource($topMark); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\TopMark $topMark
     * @return \AvisoNavAPI\Http\Resources\TopMarkResource
     */
    public function show(TopMark $topMark)
    {
        $topMark->load([
            'topMarkLang' => $this->withLanguageQuery()
        ]);
        
        return new TopMarkResource($topMark);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\TopMark\StoreTopMark  $request
     * @param  \AvisoNavAPI\TopMark $topMark
     * @return \AvisoNavAPI\Http\Resources\TopMarkResource
     */
    public function update(StoreTopMark $request, TopMark $topMark)
    {
        // $topMark->illustration = $request->input('illustration');
        
        // if($topMark->isClean()){
        //     return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        // }

        // $topMark->save();

        // return new TopMarkResource($topMark);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\TopMark $topMark
     * @return \AvisoNavAPI\Http\Resources\TopMarkResource
     */
    public function destroy(TopMark $topMark)
    {
        $topMark->delete();

        return new TopMarkResource($topMark);
    }
    
}
