<?php

namespace AvisoNavAPI\Http\Controllers\LightType;

use AvisoNavAPI\LightType;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\ModelFilters\Basic\LightTypeFilter;
use AvisoNavAPI\Http\Resources\LightType\LightTypeLangResource;
use AvisoNavAPI\Http\Requests\LightType\StoreLightTypeLang;
use AvisoNavAPI\ModelFilters\Basic\LightTypeLangFilter;
use AvisoNavAPI\LightTypeLang;

class LightTypeLangController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\LightTypeLangResource
     */
    public function index(LightType $lightType)
    {
        $collection = $lightType->lightTypeLangs()->filter(request()->all(), LightTypeLangFilter::class)
                                                  ->with(['lightType'])
                                                  ->paginateFilter($this->perPage());

        return LightTypeLangResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\LightType\StoreLightTypeLang  $request
     * @return \AvisoNavAPI\Http\Resources\LightTypeLangResource
     */
    public function store(StoreLightTypeLang $request, LightType $lightType)
    {
        $lightTypeLang = new LightTypeLang($request->only(['class', 'description']));
        $lightTypeLang->language_id = $request->input('language_id');

        $lightType->lightTypeLangs()->save($lightTypeLang);

        return new LightTypeLangResource($lightTypeLang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\LightType $lightType
     * @param  \AvisoNavAPI\LightTypeLang $lightTypeLang
     * @return \AvisoNavAPI\Http\ResourcesLightTypeResource
     */
    public function show(LightType $lightType, LightTypeLang $lightTypeLang)
    {
        return new LightTypeLangResource($lightTypeLang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\LightType\StoreLightTypeLang  $request
     * @param  \AvisoNavAPI\LightType $lightType
     * @param  \AvisoNavAPI\LightTypeLang $lightTypeLang
     * @return \AvisoNavAPI\Http\Resources\LightTypeLangResource
     */
    public function update(StoreLightTypeLang $request, LightType $lightType, LightTypeLang $lightTypeLang)
    {
        $lightTypeLang->fill($request->only(['class', 'description']));
        
        if($lightTypeLang->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }

        $lightTypeLang->save();

        return new LightTypeLangResource($lightTypeLang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\LightType $lightType
     * @param  \AvisoNavAPI\LightTypeLang $lightTypeLang
     * @return \AvisoNavAPI\Http\Resources\LightTypeLangResource
     */
    public function destroy(LightType $lightType, LightTypeLang $lightTypeLang)
    {
        $lightTypeLang->delete();

        return new LightTypeLangResource($lightTypeLang);
    }

}
