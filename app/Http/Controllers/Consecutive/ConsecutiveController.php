<?php

namespace AvisoNavAPI\Http\Controllers\Consecutive;

use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\ConsecutiveNotice;
use AvisoNavAPI\Http\Resources\ConsecutiveResource;
use AvisoNavAPI\ModelFilters\Basic\ConsecutiveFilter;
use AvisoNavAPI\Http\Requests\Consecutive\StoreConsecutive;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

class ConsecutiveController extends Controller
{
    use Filter, Responser;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = ConsecutiveNotice::filter(request()->all(), ConsecutiveFilter::class)
                            ->paginateFilter($this->perPage());

        return ConsecutiveResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConsecutive $request)
    {
        $consecutive = new ConsecutiveNotice($request->only(['number', 'year']));
        $consecutive->save();

        return new ConsecutiveResource($consecutive);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ConsecutiveNotice $consecutive)
    {
        return new ConsecutiveResource($consecutive);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreConsecutive $request, ConsecutiveNotice $consecutive)
    {
        $consecutive->fill($request->only(['number', 'year']));
        $consecutive->save();

        return new ConsecutiveResource($consecutive);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsecutiveNotice $consecutive)
    {
        $consecutive->delete();

        return new ConsecutiveResource($consecutive);
    }
}
