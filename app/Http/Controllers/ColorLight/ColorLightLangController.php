<?php

namespace AvisoNavAPI\Http\Controllers\ColorLight;

use AvisoNavAPI\ColorLight;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\ColorLight\ColorLightLangResource;
use AvisoNavAPI\ModelFilters\Basic\ColorLightLangFilter;
use AvisoNavAPI\Http\Requests\ColorLight\StoreColorLightLang;
use AvisoNavAPI\ColorLightLang;

class ColorLightLangController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\ColorLightLangResource
     */
    public function index(ColorLight $colorLight)
    {
        $collection = $colorLight->colorLightLangs()->filter(request()->all(), ColorLightLangFilter::class)
                                                  ->paginateFilter($this->perPage());

        return ColorLightLangResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\ColorLight\StoreColorLightLang  $request
     * @param  \AvisoNavAPI\ColorLight $colorLight
     * @param  \AvisoNavAPI\ColorLightLang $colorLightLang
     * @return \AvisoNavAPI\Http\Resources\ColorLightLangResource
     */
    public function store(StoreColorLightLang $request, ColorLight $colorLight)
    {

        $colorLightLang = new ColorLightLang($request->only(['color']));
        $colorLightLang->language_id = $request->input('language');

        $colorLight->colorLightLangs()->save($colorLightLang);

        return new ColorLightLangResource($colorLightLang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\ColorLight  $colorLight
     * @param  \AvisoNavAPI\ColorLightLang  $colorLightLang
     * @return \AvisoNavAPI\Http\Resources\ColorLightLangResource
     */
    public function show(ColorLight $colorLight, ColorLightLang $colorLightLang)
    {
        return new ColorLightLangResource($colorLightLang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\ColorLight\StoreColorLightLang  $request
     * @param  \AvisoNavAPI\ColorLight $colorLight
     * @param  \AvisoNavAPI\ColorLightLang $colorLightLang
     * @return \AvisoNavAPI\Http\Resources\ColorLightLangResource
     */
    public function update(StoreColorLightLang $request, ColorLight $colorLight, ColorLightLang $colorLightLang)
    {
        $colorLightLang->fill($request->only(['color']));
        $colorLightLang->language_id = $request->input('language');
        
        if($colorLightLang->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        }

        $colorLightLang->save();

        return new ColorLightLangResource($colorLightLang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\ColorLight $colorLight
     * @param  \AvisoNavAPI\ColorLightLang $colorLightLang
     * @return \AvisoNavAPI\Http\Resources\ColorLightLangResource
     */
    public function destroy(ColorLight $colorLight, ColorLightLang $colorLightLang)
    {
        $colorLightLang->delete();

        return new ColorLightLangResource($colorLightLang);
    }

}
