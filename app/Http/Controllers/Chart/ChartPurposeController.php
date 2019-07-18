<?php

namespace AvisoNavAPI\Http\Controllers\Chart;

use AvisoNavAPI\Language;
use AvisoNavAPI\ChartPurpose;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\ChartPurposeLang;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Requests\Chart\StoreChartPurpose;
use AvisoNavAPI\ModelFilters\Basic\ChartPurposeFilter;
use AvisoNavAPI\Http\Resources\Chart\ChartPurposeResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

class ChartPurposeController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = ChartPurpose::filter(request()->all(), ChartPurposeFilter::class)
                                  ->with([
                                      'chartPurposeLang' => $this->withLanguageQuery()
                                  ])
                                  ->paginateFilter($this->perPage());

        return ChartPurposeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChartPurpose $request)
    {
        $language = Language::where('code','es')->firstOrFail();

        $chartPurpose = new ChartPurpose();
        $chartPurpose->save();

        $chartPurposeLang = new ChartPurposeLang();
        $chartPurposeLang->description = $request->input('purpose');
        $chartPurposeLang->language_id = $language->id;
        $chartPurposeLang->chart_purpose_id = $chartPurpose->id;
        $chartPurposeLang->save();

        return new ChartPurposeResource($chartPurpose);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ChartPurpose $chartPurpose)
    {
        $chartPurpose->load([
            'chartPurposeLang' => $this->withLanguageQuery()
        ]);
        
        return new ChartPurposeResource($chartPurpose);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChartPurpose $chartPurpose)
    {
        $chartPurpose->delete();

        return new ChartPurposeResource($chartPurpose);
    }

}
