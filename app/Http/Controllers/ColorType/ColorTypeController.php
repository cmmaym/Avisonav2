<?php

namespace AvisoNavAPI\Http\Controllers\ColorType;

use AvisoNavAPI\ColorType;
use AvisoNavAPI\ColorTypeLang;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\ColorType\ColorTypeResource;
use AvisoNavAPI\ModelFilters\Basic\ColorTypeFilter;
use AvisoNavAPI\Http\Requests\ColorType\StoreColorType;
use AvisoNavAPI\ModelFilters\Basic\ColorTypeLangFilter;

class ColorTypeController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\ColorTypeLangResource
     */
    public function index()
    {
        $language = request()->input('language');
        $collection = ColorType::filter(request()->all(), ColorTypeFilter::class)
                               ->with([
                                   'colorTypeLang' => function($query) use ($language){
                                        $query->where('language_id', $language);
                                   } 
                                ])
                               ->paginateFilter($this->perPage());

        return ColorTypeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\ColorType\StoreColorType  $request
     * @return \AvisoNavAPI\Http\Resources\ColorTypeResource
     */
    public function store(StoreColorType $request)
    {
        $colorType = new ColorType();
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
     * @param  \AvisoNavAPI\Http\Requests\ColorType\StoreColorType  $request
     * @param  \AvisoNavAPI\ColorType $colorType
     * @return \AvisoNavAPI\Http\Resources\ColorTypeResource
     */
    public function update(StoreColorType $request, ColorType $colorType)
    {
        $colorType->fill($request->only(['state']));
        
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
