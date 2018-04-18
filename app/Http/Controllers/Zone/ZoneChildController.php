<?php

namespace AvisoNavAPI\Http\Controllers\Zone;

use AvisoNavAPI\Zone;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\ZoneResource;
use AvisoNavAPI\Http\Requests\Zone\StoreZone;
use AvisoNavAPI\ModelFilters\Basic\ZoneFilter;
use Dotenv\Exception\ValidationException;
use AvisoNavAPI\Traits\Responser;

class ZoneChildController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Zone $zone)
    {
        $collection = $zone->zone()->filter(request()->all(), ZoneFilter::class)->paginateFilter($this->perPage());

        return ZoneResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreZone $request, Zone $zone)
    {

        $this->validateChildLanguage($zone->language_id);

        $childZone = new Zone($request->only(['name', 'alias', 'state']));
        $childZone->language_id = $request->input('language_id');

        $zone->zone()->save($childZone);

        return new ZoneResource($childZone);
        
    }

}
