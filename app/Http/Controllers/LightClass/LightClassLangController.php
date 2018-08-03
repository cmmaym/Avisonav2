<?php

namespace AvisoNavAPI\Http\Controllers\LightClass;

use AvisoNavAPI\LightClass;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\ModelFilters\Basic\LightClassFilter;
use AvisoNavAPI\Http\Resources\LightClass\LightClassLangResource;
use AvisoNavAPI\Http\Requests\LightClass\StoreLightClassLang;
use AvisoNavAPI\ModelFilters\Basic\LightClassLangFilter;
use AvisoNavAPI\LightClassLang;
use AvisoNavAPI\Traits\Responser;

class LightClassLangController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\LightClassLangResource
     */
    public function index(LightClass $lightClass)
    {
        $collection = $lightClass->lightClassLangs()->filter(request()->all(), LightClassLangFilter::class)
                                                  ->with(['lightClass'])
                                                  ->paginateFilter($this->perPage());

        return LightClassLangResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\LightClass\StoreLightClassLang  $request
     * @return \AvisoNavAPI\Http\Resources\LightClassLangResource
     */
    public function store(StoreLightClassLang $request, LightClass $lightClass)
    {
        $lightClassLang = new LightClassLang($request->only(['class', 'description']));
        $lightClassLang->language_id = $request->input('language');

        $lightClass->lightClassLangs()->save($lightClassLang);

        return new LightClassLangResource($lightClassLang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\LightClass $lightClass
     * @param  \AvisoNavAPI\LightClassLang $lightClassLang
     * @return \AvisoNavAPI\Http\ResourcesLightClassResource
     */
    public function show(LightClass $lightClass, LightClassLang $lightClassLang)
    {
        return new LightClassLangResource($lightClassLang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\LightClass\StoreLightClassLang  $request
     * @param  \AvisoNavAPI\LightClass $lightClass
     * @param  \AvisoNavAPI\LightClassLang $lightClassLang
     * @return \AvisoNavAPI\Http\Resources\LightClassLangResource
     */
    public function update(StoreLightClassLang $request, LightClass $lightClass, LightClassLang $lightClassLang)
    {
        $lightClassLang->fill($request->only(['class', 'description']));
        
        if($lightClassLang->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        }

        $lightClassLang->save();

        return new LightClassLangResource($lightClassLang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\LightClass $lightClass
     * @param  \AvisoNavAPI\LightClassLang $lightClassLang
     * @return \AvisoNavAPI\Http\Resources\LightClassLangResource
     */
    public function destroy(LightClass $lightClass, LightClassLang $lightClassLang)
    {
        $lightClassLang->delete();

        return new LightClassLangResource($lightClassLang);
    }

}
