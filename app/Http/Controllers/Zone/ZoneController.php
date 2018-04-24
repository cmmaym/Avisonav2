<?php

namespace AvisoNavAPI\Http\Controllers\Zone;

use AvisoNavAPI\Zone;
use AvisoNavAPI\ZoneLang;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\ZoneResource;
use AvisoNavAPI\Http\Requests\Zone\StoreZone;
use AvisoNavAPI\ModelFilters\Basic\ZoneFilter;
use AvisoNavAPI\ModelFilters\Basic\ZoneLangFilter;
use AvisoNavAPI\Http\Resources\ZoneLangResource;

class ZoneController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\ZoneResource
     */
    public function index()
    {
        $collection = ZoneLang::filter(request()->all(), ZoneLangFilter::class)
                              ->with(['zone'])
                              ->paginateFilter($this->perPage());

        return ZoneLangResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Zone\StoreZone  $request
     * @return \AvisoNavAPI\Http\Resources\ZoneResource
     */
    public function store(StoreZone $request)
    {
        $zone = new Zone();
        $zone->save();

        return new ZoneResource($zone);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Zone  $zone
     * @return \AvisoNavAPI\Http\Resources\ZoneResource
     */
    public function show(Zone $zone)
    {
        return new ZoneResource($zone);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Zone\StoreZone  $request
     * @param  \AvisoNavAPI\Zone  $zone
     * @return \AvisoNavAPI\Http\Resources\ZoneResource
     */
    public function update(StoreZone $request, Zone $zone)
    {
        $zone->fill($request->only(['state']));
        
        if($zone->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }

        $zone->save();

        return new ZoneResource($zone);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Zone  $zone
     * @return \AvisoNavAPI\Http\Resources\ZoneResource
     */
    public function destroy(Zone $zone)
    {
        $zone->delete();

        return new ZoneResource($zone);
    }
}
