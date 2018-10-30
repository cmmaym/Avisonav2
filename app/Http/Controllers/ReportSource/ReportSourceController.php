<?php

namespace AvisoNavAPI\Http\Controllers\ReportSource;

use AvisoNavAPI\ReportSource;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\ReportSourceResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use AvisoNavAPI\ModelFilters\Basic\ReportSourceFilter;
use AvisoNavAPI\Http\Requests\ReportSource\StoreReportSource;
use AvisoNavAPI\Traits\Responser;

class ReportSourceController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\ReportSourceResource
     */
    public function index()
    {        
        $collection = ReportSource::filter(request()->all(), ReportSourceFilter::class)
                                     ->paginateFilter($this->perPage());

        return ReportSourceResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\ReportSource\StoreReportSource  $request
     * @return \AvisoNavAPI\Http\Resources\ReportSourceResource
     */
    public function store(StoreReportSource $request)
    {        
        $reportSource = new ReportSource($request->only(['name', 'alias']));
        $reportSource->save();

        return new ReportSourceResource($reportSource);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\ReportSource  ReportSource
     * @return \AvisoNavAPI\Http\Resources\ReportSourceResource
     */
    public function show(ReportSource $reportSource)
    {        
        return new ReportSourceResource($reportSource);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\ReportSource\StoreReportSource  $request
     * @param  \AvisoNavAPI\ReportSource    ReportSource
     * @return \AvisoNavAPI\Http\Resources\ReportSourceResource
     */
    public function update(StoreReportSource $request, ReportSource $reportSource)
    {        
        $reportSource->fill($request->only(['name', 'alias']));
        
        $reportSource->save();

       return new ReportSourceResource($reportSource);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\ReportSource    ReportSource
     * @return \AvisoNavAPI\Http\Resources\ReportSourceResource
     */
    public function destroy(ReportSource $reportSource)
    {        
        $reportSource->delete();

        return new ReportSourceResource($reportSource);
    }
}