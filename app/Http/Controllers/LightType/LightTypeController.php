<?php

namespace AvisoNavAPI\Http\Controllers\LightType;

use AvisoNavAPI\LightType;
use AvisoNavAPI\LightTypeLang;
use AvisoNavAPI\Traits\Filter;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\LightType\LightTypeResource;
use AvisoNavAPI\ModelFilters\Basic\LightTypeFilter;
// use AvisoNavAPI\Http\Resources\LightTypeLangResource;
use AvisoNavAPI\Http\Requests\LightType\StoreLightType;
use AvisoNavAPI\ModelFilters\Basic\LightTypeLangFilter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use AvisoNavAPI\Traits\Responser;

class LightTypeController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\LightTypeResource
     */
    public function index()
    {
        $collection = LightType::filter(request()->all(), LightTypeFilter::class)
                                   ->with([
                                       'lightTypeLang' => $this->withLanguageQuery()
                                    ]) 
                                   ->paginateFilter($this->perPage());

        return LightTypeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\LightType\StoreLightType  $request
     * @return \AvisoNavAPI\Http\Resources\LightTypeResource
     */
    public function store(StoreLightType $request)
    {
        $lightType = new LightType($request->only(['alias', 'illustration']));
        $lightType->save();
        
        return new LightTypeResource($lightType); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\LightType $lightType
     * @return \AvisoNavAPI\Http\Resources\LightTypeResource
     */
    public function show(LightType $lightType)
    {
        return new LightTypeResource($lightType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\LightType\StoreLightType  $request
     * @param  \AvisoNavAPI\LightType $lightType
     * @return \AvisoNavAPI\Http\Resources\LightTypeResource
     */
    public function update(StoreLightType $request, LightType $lightType)
    {
        $lightType->fill($request->only(['alias', 'illustration', 'state']));
        
        if($lightType->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }

        $lightType->save();

        return new LightTypeResource($lightType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\LightType $lightType
     * @return \AvisoNavAPI\Http\Resources\LightTypeResource
     */
    public function destroy(LightType $lightType)
    {
        $lightType->delete();

        return new LightTypeResource($lightType);
    }
    
}
