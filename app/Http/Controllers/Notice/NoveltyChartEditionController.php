<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use AvisoNavAPI\Novelty;
use Illuminate\Http\Request;
use AvisoNavAPI\ChartEdition;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Facades\Auth;
use AvisoNavAPI\ModelFilters\Basic\ChartEditionFilter;
use AvisoNavAPI\Http\Resources\Chart\ChartEditionResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

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
        $user = Auth::user();
        
        $novelty->chartEdition()->attach($chartEdition->id, [
            'created_by' => $user->username,
            'updated_by' => $user->username,
        ]);
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
