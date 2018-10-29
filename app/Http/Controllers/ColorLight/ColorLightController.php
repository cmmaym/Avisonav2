<?php

namespace AvisoNavAPI\Http\Controllers\ColorLight;

use AvisoNavAPI\Language;
use AvisoNavAPI\ColorLight;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\ColorLightLang;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\ModelFilters\Basic\ColorLightFilter;
use AvisoNavAPI\ModelFilters\Basic\ColorLightLangFilter;
use AvisoNavAPI\Http\Requests\ColorLight\StoreColorLight;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\ColorLight\ColorLightResource;

class ColorLightController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\ColorLightLangResource
     */
    public function index()
    {
        $collection = ColorLight::filter(request()->all(), ColorLightFilter::class)
                               ->with([
                                   'colorLightLang' => $this->withLanguageQuery()
                                ])
                               ->paginateFilter($this->perPage());

        return ColorLightResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\ColorLight\StoreColorLight  $request
     * @return \AvisoNavAPI\Http\Resources\ColorLightResource
     */
    public function store(StoreColorLight $request)
    {
        $language = Language::where('code','es')->firstOrFail();

        $colorLight = new ColorLight($request->only(['alias']));
        $colorLight->save();

        $colorLightLang = new ColorLightLang($request->only(['color']));
        $colorLightLang->language_id = $language->id;

        $colorLight->colorLightLangs()->save($colorLightLang);
        
        return new ColorLightResource($colorLight);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\ColorLight  $colorLight
     * @return \AvisoNavAPI\Http\Resources\ColorLightResource
     */
    public function show(ColorLight $colorLight)
    {
        $colorLight->load([
            'colorLightLang' => $this->withLanguageQuery()
        ]);

        return new ColorLightResource($colorLight);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\ColorLight\StoreColorLight  $request
     * @param  \AvisoNavAPI\ColorLight $colorLight
     * @return \AvisoNavAPI\Http\Resources\ColorLightResource
     */
    public function update(StoreColorLight $request, ColorLight $colorLight)
    {
        $colorLight->fill($request->only(['alias']));
        
        if($colorLight->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        }

        $colorLight->save();

        return new ColorLightResource($colorLight);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\ColorLight $colorLight
     * @return \AvisoNavAPI\Http\Resources\ColorLightResource
     */
    public function destroy(ColorLight $colorLight)
    {
        $colorLight->delete();

        return new ColorLightResource($colorLight);
    }

}
