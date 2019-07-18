<?php

namespace AvisoNavAPI\Http\Controllers\Chart;

use AvisoNavAPI\ChartPurpose;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\ChartPurposeLang;
use AvisoNavAPI\Http\Requests\Chart\StoreChartPurposeLang;
use AvisoNavAPI\Http\Resources\Chart\ChartPurposeResource;
use AvisoNavAPI\ModelFilters\Basic\ChartPurposeLangFilter;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\Chart\ChartPurposeLangResource;

class ChartPurposeLangController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ChartPurpose $chartPurpose)
    {
        $collection = $chartPurpose->chartPurposeLangs()->filter(request()->all(), ChartPurposeLangFilter::class)
                                  ->with([
                                      'chartPurpose'
                                  ])
                                  ->paginateFilter($this->perPage());

        return ChartPurposeLangResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Chart\StoreChartPurposeLang  $request
     * @param  \AvisoNavAPI\ChartPurpose  $chartPurpose
     * @return  \AvisoNavAPI\Http\Resources\ChartPurposeLangResource
     */
    public function store(StoreChartPurposeLang $request, ChartPurpose $chartPurpose)
    {
        $chartPurposeLang = new ChartPurposeLang();
        $chartPurposeLang->description = $request->input('purpose');
        $chartPurposeLang->language_id = $request->input('language');

        $chartPurpose->chartPurposeLangs()->save($chartPurposeLang);

        return new ChartPurposeLangResource($chartPurposeLang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\ChartPurpose  $chartPurpose
     * @param  \AvisoNavAPI\ChartPurposeLang  $chartPurposeLang
     * @return \AvisoNavAPI\Http\Resources\ChartPurposeLangResource
     */
    public function show(ChartPurpose $chartPurpose, ChartPurposeLang $chartPurposeLang)
    {
        return new ChartPurposeLangResource($chartPurposeLang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Chart\StoreChartPurposeLang  $request
     * @param  \AvisoNavAPI\ChartPurpose  $chartPurpose
     * @param  \AvisoNavAPI\ChartPurposeLang  $chartPurposeLang
     * @return \AvisoNavAPI\Http\Resources\ChartPurposeLangResource
     */
    public function update(StoreChartPurposeLang $request, ChartPurpose $chartPurpose, ChartPurposeLang $chartPurposeLang)
    {
        $chartPurposeLang->description = $request->input('purpose');
        $chartPurposeLang->language_id = $request->input('language');

        $chartPurposeLang->save();

        return new ChartPurposeLangResource($chartPurposeLang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChartPurpose $chartPurpose, ChartPurposeLang $chartPurposeLang)
    {
        $chartPurposeLang->delete();

        return new ChartPurposeLangResource($chartPurposeLang);
    }

}
