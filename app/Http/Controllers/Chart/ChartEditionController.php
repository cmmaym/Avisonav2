<?php

namespace AvisoNavAPI\Http\Controllers\Chart;

use AvisoNavAPI\ChartEdition;
use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Chart;
use AvisoNavAPI\Http\Resources\ChartEditionResource;

class ChartEditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Chart $chart)
    {
        $collection = $chart->chartEdition;

        return ChartEditionResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Chart $chart)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\ChartEdition  $chartEdition
     * @return \Illuminate\Http\Response
     */
    public function show(Chart $chart, ChartEdition $chartEdition)
    {
        return new ChartEdition($chartEdition);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \AvisoNavAPI\ChartEdition  $chartEdition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Chart $chart, ChartEdition $chartEdition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\ChartEdition  $chartEdition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chart $chart, ChartEdition $chartEdition)
    {
        return new ChartEdition($chartEdition);
    }
}
