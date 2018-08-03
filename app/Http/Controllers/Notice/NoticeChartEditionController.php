<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Notice;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\ModelFilters\Basic\ChartEditionFilter;
use AvisoNavAPI\Http\Resources\Chart\ChartEditionResource;
use AvisoNavAPI\ChartEdition;
use AvisoNavAPI\Traits\Responser;

class NoticeChartEditionController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Aid\AidResource
     */
    public function index(Notice $notice)
    {
        $collection = $notice->chartEdition()->filter(request()->all(), ChartEditionFilter::class)
                                    ->with([
                                        'chart'
                                    ])
                                    ->paginateFilter($this->perPage());

        return ChartEditionResource::collection($collection);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Notice $notice
     * @param  \AvisoNavAPI\ChartEdition $chartEdition
     * @return \Illuminate\Http\Response
     */
    public function update(Notice $notice, ChartEdition $chartEdition)
    {
        $notice->chartEdition()->attach($chartEdition->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Notice  $notice
     * @param  \AvisoNavAPI\ChartEdition  $chartEdition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice, ChartEdition $chartEdition)
    {
        $notice->chartEdition()->detach($chartEdition->id);
    }

}
