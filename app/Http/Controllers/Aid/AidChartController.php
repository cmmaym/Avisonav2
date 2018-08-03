<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use AvisoNavAPI\Aid;
use AvisoNavAPI\Chart;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Resources\Chart\ChartResource;
use AvisoNavAPI\ModelFilters\Basic\ChartFilter;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

class AidChartController extends Controller
{

    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Aid $aid)
    {
        $collection = $aid->chart()->filter(request()->all(), ChartFilter::class)
                                   ->paginateFilter($this->perPage());;

        return ChartResource::collection($collection);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Aid $aid, Chart $chart)
    {
        $aid->chart()->attach($chart->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aid $aid, Chart $chart)
    {
        $aid->chart()->detach($chart->id);
    }
}
