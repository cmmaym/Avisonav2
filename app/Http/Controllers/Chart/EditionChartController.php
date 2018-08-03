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

class EditionChartController extends Controller
{
    use Filter, Responser;
    
    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Chart\ChartEditionResource
     */
    public function index()
    {
        $collection = ChartEdition::filter(request()->all(), ChartEditionFilter::class)
                                              ->with(['chart'])
                                              ->paginateFilter($this->perPage());

        return ChartEditionResource::collection($collection);
    }
}
