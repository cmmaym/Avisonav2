<?php

namespace AvisoNavAPI\Http\Controllers\Chart;

use AvisoNavAPI\Chart;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\ModelFilters\Basic\ChartFilter;
use AvisoNavAPI\Http\Resources\ChartResource;
use AvisoNavAPI\Http\Requests\Chart\StoreChart;

class ChartController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Chart::filter(request()->all(), ChartFilter::class)
                            ->with(['chartEdition'])
                            ->paginateFilter($this->perPage());

        return ChartResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChart $request)
    {
        $chart = new Chart($request->only(['number', 'purpose', 'state']));
        $chart->user = 'JMARDZ';
        $chart->save();

        return new ChartResource($chart);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Chart $chart)
    {
        return new ChartResource($chart);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreChart $request, Chart $chart)
    {
        $chart->fill($request->only(['number', 'purpose', 'state']));
        $chart->user = 'JMARDZ';
        $chart->save();

        if($chart->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }

        return new ChartResource($chart);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chart $chart)
    {
        $chart->delete();

        return new ChartResource($chart);
    }
}
