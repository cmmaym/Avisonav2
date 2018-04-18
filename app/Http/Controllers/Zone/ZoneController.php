<?php

namespace AvisoNavAPI\Http\Controllers\Zone;

use AvisoNavAPI\Zone;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\ZoneResource;
use AvisoNavAPI\Http\Requests\Zone\StoreZone;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use AvisoNavAPI\ModelFilters\Basic\ZoneFilter;
use AvisoNavAPI\Traits\Filter;

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
        $collection = Zone::where('parent_id', null)->filter(request()->all(), ZoneFilter::class)->paginateFilter($this->perPage());

        return ZoneResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Zona\StoreZone  $request
     * @return \AvisoNavAPI\Http\Resources\ZoneResource
     */
    public function store(StoreZone $request)
    {
        $zone = new Zone($request->only(['name', 'alias', 'state']));
        $zone->language_id = $request->input('language_id');
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
     * @param  \AvisoNavAPI\Http\Requests\Zona\StoreZone  $request
     * @param  \AvisoNavAPI\Zone  $zona
     * @return \AvisoNavAPI\Http\Resources\ZoneResource
     */
    public function update(StoreZone $request, Zone $zone)
    {
        $zone->fill($request->only(['name', 'alias', 'state']));

        //Si es un child validamos que no puedan cambiar su idioma
        //por el mismo idioma que tenga el su parent
        if(!is_null($zone->parent_id)){
            $parent = $zone->parent;
            if($language_id = $request->input('language_id') != $parent->language_id){
                $zone->language_id = $language_id;
            }
        }
        
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
