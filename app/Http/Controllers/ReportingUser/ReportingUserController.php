<?php

namespace AvisoNavAPI\Http\Controllers\ReportingUser;

use AvisoNavAPI\ReportingUser;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\ReportingUserResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use AvisoNavAPI\ModelFilters\Basic\ReportingUserFilter;
use AvisoNavAPI\Http\Requests\ReportingUser\StoreReportingUSer;
use AvisoNavAPI\Traits\Responser;

class ReportingUserController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\ReportingUserResource
     */
    public function index()
    {        
        $collection = ReportingUser::filter(request()->all(), ReportingUserFilter::class)
                                     ->paginateFilter($this->perPage());

        return ReportingUserResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\ReportSource\StoreReportSource  $request
     * @return \AvisoNavAPI\Http\Resources\ReportSourceResource
     */
    public function store(StoreReportingUser $request)
    {        
        $reportingUser = new ReportingUser($request->only(['name', 'rank']));
        $reportingUser->save();

        return new ReportingUserResource($reportingUser);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\ReportingUser  ReportingUser
     * @return \AvisoNavAPI\Http\Resources\ReportingUserResource
     */
    public function show(ReportingUser $reportingUser)
    {        
        return new ReportingUserResource($reportingUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\ReportingUser\StoreReportingUser  $request
     * @param  \AvisoNavAPI\ReportingUser    ReportingUser
     * @return \AvisoNavAPI\Http\Resources\ReportingUserResource
     */
    public function update(StoreReportingUser $request, ReportingUser $reportingUser)
    {        
        $reportingUser->fill($request->only(['name', 'rank']));
        
        if($reportingUser->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        }
        
        $reportingUser->save();

       return new ReportingUserResource($reportingUser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\ReportingUser    ReportingUser
     * @return \AvisoNavAPI\Http\Resources\ReportingUserResource
     */
    public function destroy(ReportingUser $reportingUser)
    {        
        $reportingUser->delete();

        return new ReportingUserResource($reportingUser);
    }
}