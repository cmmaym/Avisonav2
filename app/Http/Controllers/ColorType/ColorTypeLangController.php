<?php

namespace AvisoNavAPI\Http\Controllers\ColorType;

use AvisoNavAPI\ColorType;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\ColorType\ColorTypeLangResource;
use AvisoNavAPI\ModelFilters\Basic\ColorTypeLangFilter;
use AvisoNavAPI\Http\Requests\ColorType\StoreColorTypeLang;
use AvisoNavAPI\ColorTypeLang;

class ColorTypeLangController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\ColorTypeLangResource
     */
    public function index(ColorType $colorType)
    {
        $collection = $colorType->colorTypeLangs()->filter(request()->all(), ColorTypeLangFilter::class)
                                                  ->paginateFilter($this->perPage());

        return ColorTypeLangResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\ColorType\StoreColorTypeLang  $request
     * @param  \AvisoNavAPI\ColorType $colorType
     * @param  \AvisoNavAPI\ColorTypeLang $colorTypeLang
     * @return \AvisoNavAPI\Http\Resources\ColorTypeLangResource
     */
    public function store(StoreColorTypeLang $request, ColorType $colorType)
    {

        $colorTypeLang = new ColorTypeLang($request->only(['color', 'alias']));
        $colorTypeLang->language_id = $request->input('language_id');

        $colorType->colorTypeLangs()->save($colorTypeLang);

        return new ColorTypeLangResource($colorTypeLang);        
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\ColorType  $colorType
     * @param  \AvisoNavAPI\ColorTypeLang  $colorTypeLang
     * @return \AvisoNavAPI\Http\Resources\ColorTypeLangResource
     */
    public function show(ColorType $colorType, ColorTypeLang $colorTypeLang)
    {
        return new ColorTypeLangResource($colorTypeLang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\ColorType\StoreColorTypeLang  $request
     * @param  \AvisoNavAPI\ColorType $colorType
     * @param  \AvisoNavAPI\ColorTypeLang $colorTypeLang
     * @return \AvisoNavAPI\Http\Resources\ColorTypeLangResource
     */
    public function update(StoreColorTypeLang $request, ColorType $colorType, ColorTypeLang $colorTypeLang)
    {
        $colorTypeLang->fill($request->only(['color', 'alias']));
        
        if($colorTypeLang->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }

        $colorTypeLang->save();

        return new ColorTypeLangResource($colorTypeLang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\ColorType $colorType
     * @param  \AvisoNavAPI\ColorTypeLang $colorTypeLang
     * @return \AvisoNavAPI\Http\Resources\ColorTypeLangResource
     */
    public function destroy(ColorType $colorType, ColorTypeLang $colorTypeLang)
    {
        $colorTypeLang->delete();

        return new ColorTypeLangResource($colorTypeLang);
    }

}
