<?php

namespace AvisoNavAPI\Http\Controllers\Chart;

use AvisoNavAPI\Chart;
use AvisoNavAPI\ChartEdition;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Requests\Chart\StoreChartEdition;
use AvisoNavAPI\ModelFilters\Basic\ChartEditionFilter;
use AvisoNavAPI\Http\Resources\Chart\ChartEditionResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

class ChartEditionController extends Controller
{
    use Filter, Responser;
    
    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Chart\ChartEditionResource
     */
    public function index(Chart $chart)
    {
        $collection = $chart->chartEdition()->filter(request()->all(), ChartEditionFilter::class)
                                              ->with(['chart'])
                                              ->paginateFilter($this->perPage());

        return ChartEditionResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Chart\StoreChartEdition  $request
     * @return \AvisoNavAPI\Http\Resources\Chart\ChartEditionResource
     */
    public function store(StoreChartEdition $request, Chart $chart)
    {
        $lastEdition = $chart->edition()->where('state', '=', 'C')->first();

        $chartEdition = new ChartEdition($request->only(['edition', 'year']));
        $chartEdition->state = 'C';
        
        $chart->chartEdition()->save($chartEdition);

        if($lastEdition)
        {
            $lastEdition->state = 'A';
            $lastEdition->save();
        }

        return new ChartEditionResource($chartEdition);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Chart $chart
     * @param  \AvisoNavAPI\ChartEdition $chartEdition
     * @return \AvisoNavAPI\Http\Resources\Chart\ChartEditionResource
     */
    public function show(Chart $chart, ChartEdition $chartEdition)
    {
        return new ChartEditionResource($chartEdition);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Chart\StoreChartEdition  $request
     * @param  \AvisoNavAPI\Chart $chart
     * @param  \AvisoNavAPI\ChartEdition $chartEdition
     * @return \AvisoNavAPI\Http\Resources\Chart\ChartEditionResource
     */
    public function update(StoreChartEdition $request, Chart $chart, ChartEdition $chartEdition)
    {
        $chartEdition->fill($request->only(['edition', 'year']));

        $chartEdition->save();

        return new ChartEditionResource($chartEdition);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Chart $chart
     * @param  \AvisoNavAPI\ChartEdition $chartEditionId
     * @return \AvisoNavAPI\Http\Resources\Chart\ChartEditionResource
     */
    public function destroy(Chart $chart, $id)
    {
        $chartEdition = $chart->chartEdition()->findOrFail($id);

        $chartEdition->delete();

        $currentchartEdition = $chart->chartEdition()->orderBy('created_at', 'desc')->first();

        if($currentchartEdition)
        {
            $currentchartEdition->state = 'C';
            $currentchartEdition->save();
        }

        return new ChartEditionResource($chartEdition);
    }
}
