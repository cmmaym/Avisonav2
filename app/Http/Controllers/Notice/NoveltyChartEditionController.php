<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Novelty;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\ModelFilters\Basic\ChartEditionFilter;
use AvisoNavAPI\Http\Resources\Chart\ChartEditionResource;
use AvisoNavAPI\ChartEdition;
use AvisoNavAPI\Traits\Responser;

class NoveltyChartEditionController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Novelty\NoveltyResource
     */
    public function index(Novelty $novelty)
    {
        $collection = $novelty->chartEdition()->filter(request()->all(), ChartEditionFilter::class)
                                    ->with([
                                        'chart'
                                    ])
                                    ->paginateFilter($this->perPage());

        return ChartEditionResource::collection($collection);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Novelty $novelty
     * @param  \AvisoNavAPI\ChartEdition $chartEdition
     * @return \Illuminate\Http\Response
     */
    public function update(Novelty $novelty, ChartEdition $chartEdition)
    {
        $novelty->chartEdition()->attach($chartEdition->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Novelty  $novelty
     * @param  \AvisoNavAPI\ChartEdition  $chartEdition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Novelty $novelty, ChartEdition $chartEdition)
    {
        $novelty->chartEdition()->detach($chartEdition->id);
    }

}
