<?php

namespace AvisoNavAPI\Http\Controllers\LightType;

use AvisoNavAPI\LightType;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\LightTypeResource;
use AvisoNavAPI\Http\Requests\LightType\StoreLightType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\ModelFilters\Basic\LightTypeFilter;

class LightTypeController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\LightTypeResource
     */
    public function index()
    {
        $collection = LightType::where('parent_id', null)->filter(request()->all(), LightTypeFilter::class)->paginateFilter($this->perPage());

        return LightTypeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\TipoLuz\StoreLightType  $request
     * @return \AvisoNavAPI\Http\Resources\LightTypeResource
     */
    public function store(StoreLightType $request)
    {
        $colorType = new LightType($request->only(['class', 'alias', 'description', 'illustration', 'state']));
        $colorType->language_id = $request->input('language_id');
        $colorType->save();
        
        return new LightTypeResource($colorType); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\LightType $lightType
     * @return \AvisoNavAPI\Http\ResourcesLightTypeResource
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
        $lightType->fill($request->only(['class', 'alias', 'description', 'illustration', 'state']));

        //Si es un child validamos que no puedan cambiar su idioma
        //por el mismo idioma que tenga el su parent
        if(!is_null($lightType->parent_id)){
            $parent = $lightType->parent;
            if($language_id = $request->input('language_id') != $parent->language_id){
                $lightType->language_id = $language_id;
            }
        }
        
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
