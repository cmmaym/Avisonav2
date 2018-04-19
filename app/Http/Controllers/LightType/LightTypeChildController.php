<?php

namespace AvisoNavAPI\Http\Controllers\LightType;

use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\LightType;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\ModelFilters\Basic\LightTypeFilter;
use AvisoNavAPI\Http\Resources\LightTypeResource;
use AvisoNavAPI\Http\Requests\LightType\StoreLightType;

class LightTypeChildController extends Controller
{
    use Filter, Responser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LightType $lightType)
    {
        $collection = $lightType->lightType()->filter(request()->all(), LightTypeFilter::class)->paginateFilter($this->perPage());

        return LightTypeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLightType $request, LightType $lightType)
    {
        $this->validateChildLanguage($lightType->language_id);

        $childLightType = new LightType($request->only(['class', 'alias', 'description', 'state']));
        $childLightType->language_id = $request->input('language_id');
        $childLightType->illustration = $lightType->illustration;

        $lightType->lightType()->save($childLightType);

        return new LightTypeResource($childLightType);
    }

}
