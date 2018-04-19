<?php

namespace AvisoNavAPI\Http\Controllers\ColorType;

use AvisoNavAPI\ColorType;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\ColorTypeResource;
use AvisoNavAPI\Http\Requests\ColorType\StoreColorType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\ModelFilters\Basic\ColorTypeFilter;

class ColorTypeController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\ColorTypeResource
     */
    public function index()
    {
        $collection = ColorType::where('parent_id', null)->filter(request()->all(), ColorTypeFilter::class)->paginateFilter($this->perPage());

        return ColorTypeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\TipoColor\StoreColorType  $request
     * @return \AvisoNavAPI\Http\Resources\ColorTypeResource
     */
    public function store(StoreColorType $request)
    {
        $colorType = new ColorType($request->only(['color', 'alias', 'state']));
        $colorType->language_id = $request->input('language_id');
        $colorType->save();
        
        return new ColorTypeResource($colorType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\ColorType  $colorType
     * @return \AvisoNavAPI\Http\Resources\ColorTypeResource
     */
    public function show(ColorType $colorType)
    {
        return new ColorTypeResource($colorType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\TipoColor\StoreColorType  $request
     * @param  \AvisoNavAPI\ColorType $colorType
     * @return \AvisoNavAPI\Http\Resources\ColorTypeResource
     */
    public function update(StoreColorType $request, ColorType $colorType)
    {
        $colorType->fill($request->only(['color', 'alias', 'state']));

        //Si es un child validamos que no puedan cambiar su idioma
        //por el mismo idioma que tenga el su parent
        if(!is_null($colorType->parent_id)){
            $parent = $colorType->parent;
            if($language_id = $request->input('language_id') != $parent->language_id){
                $colorType->language_id = $language_id;
            }
        }
        
        if($colorType->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }

        $colorType->save();

        return new ColorTypeResource($colorType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\ColorType $colorType
     * @return \AvisoNavAPI\Http\Resources\ColorTypeResource
     */
    public function destroy(ColorType $colorType)
    {
        $colorType->delete();

        return new ColorTypeResource($colorType);
    }
}
