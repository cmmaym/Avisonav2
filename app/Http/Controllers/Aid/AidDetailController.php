<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use AvisoNavAPI\Aid;
use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\ModelFilters\Basic\AidDetailFilter;
use AvisoNavAPI\Http\Resources\AidDetailResource;

class AidDetailController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Aid $aid)
    {
        $collection = $aid->aidDetail()->filter(request()->all(), AidDetailFilter::class)->paginateFilter($this->perPage());

        return AidDetailResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
