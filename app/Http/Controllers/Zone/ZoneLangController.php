<?php

namespace AvisoNavAPI\Http\Controllers\Zone;

use AvisoNavAPI\Zone;
use AvisoNavAPI\ZoneLang;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\Zone\ZoneLangResource;
use AvisoNavAPI\ModelFilters\Basic\ZoneLangFilter;
use AvisoNavAPI\Http\Requests\Zone\StoreZoneLang;

class ZoneLangController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return  \AvisoNavAPI\Http\Resources\ZoneLangResource
     */
    public function index(Zone $zone)
    {
        $collection = $zone->zoneLangs()->filter(request()->all(), ZoneLangFilter::class)
                                       ->with(['zone'])
                                       ->paginateFilter($this->perPage());

        return ZoneLangResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Zone\StoreZoneLang  $request
     * @param  \AvisoNavAPI\Zone  $zone
     * @return  \AvisoNavAPI\Http\Resources\ZoneLangResource
     */
    public function store(StoreZoneLang $request, Zone $zone)
    {
        $zoneLang = new ZoneLang($request->only(['name', 'alias']));
        $zoneLang->language_id = $request->input('language_id');

        $zone->zoneLangs()->save($zoneLang);

        return new ZoneLangResource($zoneLang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Zone  $zone
     * @param  \AvisoNavAPI\ZoneLang  $zoneLang
     * @return \AvisoNavAPI\Http\Resources\ZoneLangResource
     */
    public function show(Zone $zone, ZoneLang $zoneLang)
    {
        return new ZoneLangResource($zoneLang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Zone\StoreZoneLang  $request
     * @param  \AvisoNavAPI\Zone  $zone
     * @param  \AvisoNavAPI\ZoneLang  $zoneLang
     * @return \AvisoNavAPI\Http\Resources\ZoneLangResource
     */
    public function update(StoreZoneLang $request, Zone $zone, ZoneLang $zoneLang)
    {
        $zoneLang->fill($request->only(['name', 'alias']));
        
        if($zoneLang->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }

        $zoneLang->save();

        return new ZoneLangResource($zoneLang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Zone  $zone
     * @param  \AvisoNavAPI\ZoneLang  $zoneLang
     * @return \AvisoNavAPI\Http\Resources\ZoneLangResource
     */
    public function destroy(Zone $zone, ZoneLang $zoneLang)
    {
        $zoneLang->delete();

        return new ZoneLangResource($zoneLang);
    }

}
