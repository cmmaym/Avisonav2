<?php

namespace AvisoNavAPI\Http\Controllers\CatalogOceanCoast;

use AvisoNavAPI\CatalogOceanCoast;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\ModelFilters\Basic\CatalogOceanCoastFilter;
use AvisoNavAPI\Http\Resources\CatalogOceanCoastResource;
use AvisoNavAPI\Http\Requests\CatalogOceanCoast\StoreCatalogOceanCoast;
use AvisoNavAPI\Traits\Responser;

class CatalogOceanCoastController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = CatalogOceanCoast::filter(request()->all(), CatalogOceanCoastFilter::class)
                            ->paginateFilter($this->perPage());

        return CatalogOceanCoastResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCatalogOceanCoast $request)
    {
        $catalogOceanCoast = new CatalogOceanCoast($request->only(['edition', 'year']));
        $catalogOceanCoast->save();

        return new CatalogOceanCoastResource($catalogOceanCoast);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CatalogOceanCoast $catalogOceanCoast)
    {
        return new CatalogOceanCoastResource($catalogOceanCoast);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCatalogOceanCoast $request, CatalogOceanCoast $catalogOceanCoast)
    {
        $catalogOceanCoast->fill($request->only(['edition', 'year']));
        $catalogOceanCoast->save();

        return new CatalogOceanCoastResource($catalogOceanCoast);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatalogOceanCoast $catalogOceanCoast)
    {
        $catalogOceanCoast->delete();

        return new CatalogOceanCoastResource($catalogOceanCoast);
    }
}
