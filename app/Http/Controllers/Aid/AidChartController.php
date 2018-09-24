<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use AvisoNavAPI\Aid;
use AvisoNavAPI\Chart;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Facades\Auth;
use AvisoNavAPI\ModelFilters\Basic\ChartFilter;
use AvisoNavAPI\Http\Resources\Chart\ChartResource;
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
        $collection = $aid->symbol->chart()->filter(request()->all(), ChartFilter::class)
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
        $user = Auth::user();

        $aid->symbol->chart()->attach($chart->id, [
            'created_by' => $user->username,
            'updated_by' => $user->username,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aid $aid, Chart $chart)
    {
        $aid->symbol->chart()->detach($chart->id);
    }
}
