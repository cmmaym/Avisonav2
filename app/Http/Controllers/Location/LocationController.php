<?php

namespace AvisoNavAPI\Http\Controllers\Location;

use AvisoNavAPI\Location;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\LocationResource;
use AvisoNavAPI\ModelFilters\Basic\LocationFilter;
use AvisoNavAPI\Http\Requests\Location\StoreLocation;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\ModelFilters\Basic\ZoneFilter;
use AvisoNavAPI\Traits\Responser;

class LocationController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\LocationResource
     */
    public function index()
    {
        $input = request()->all();
        $collection = Location::filter(request()->all(), LocationFilter::class)
                              ->with([
                                  'zone.zoneLang' => $this->withLanguageQuery()
                              ])
                              ->orderBy('is_legacy', 'asc')
                              ->paginateFilter($this->perPage());
        
        return LocationResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Ubicacion\StoreLocation  $request
     * @return \AvisoNavAPI\Http\Resources\LocationResource
     */
    public function store(StoreLocation $request)
    {
        $location = new Location($request->only(['name','subLocationName']));
        $location->zone_id = $request->input('zone');
        $location->save();

        return new LocationResource($location);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Location  $location
     * @return \AvisoNavAPI\Http\Resources\LocationResource
     */
    public function show(Location $location)
    {
        $location->load([
            'zone.zoneLang' => $this->withLanguageQuery()
        ]);

        return new LocationResource($location);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Location\StoreLocation  $request
     * @param  \AvisoNavAPI\Location  $location
     * @return \AvisoNavAPI\Http\Resources\LocationResource
     */
    public function update(StoreLocation $request, Location $location)
    {
        $location->fill($request->only(['name','subLocationName']));
        $location->zone_id = $request->input('zone');

        $location->save();

        return new LocationResource($location);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Location  $location
     * @return \AvisoNavAPI\Http\Resources\LocationResource
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return new LocationResource($location);
    }
}
