<?php

namespace AvisoNavAPI\Http\Controllers\ColorStructure;

use AvisoNavAPI\ColorStructure;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\ColorStructure\ColorStructureLangResource;
use AvisoNavAPI\ModelFilters\Basic\ColorStructureLangFilter;
use AvisoNavAPI\Http\Requests\ColorStructure\StoreColorStructureLang;
use AvisoNavAPI\ColorStructureLang;

class ColorStructureLangController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\ColorStructureLangResource
     */
    public function index(ColorStructure $colorStructure)
    {
        $collection = $colorStructure->colorStructureLangs()->filter(request()->all(), ColorStructureLangFilter::class)
                                                  ->paginateFilter($this->perPage());

        return ColorStructureLangResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\ColorStructure\StoreColorStructureLang  $request
     * @param  \AvisoNavAPI\ColorStructure $colorStructure
     * @param  \AvisoNavAPI\ColorStructureLang $colorStructureLang
     * @return \AvisoNavAPI\Http\Resources\ColorStructureLangResource
     */
    public function store(StoreColorStructureLang $request, ColorStructure $colorStructure)
    {

        $colorStructureLang = new ColorStructureLang($request->only(['name']));
        $colorStructureLang->language_id = $request->input('language');

        $colorStructure->colorStructureLangs()->save($colorStructureLang);

        return new ColorStructureLangResource($colorStructureLang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\ColorStructure  $colorStructure
     * @param  \AvisoNavAPI\ColorStructureLang  $colorStructureLang
     * @return \AvisoNavAPI\Http\Resources\ColorStructureLangResource
     */
    public function show(ColorStructure $colorStructure, ColorStructureLang $colorStructureLang)
    {
        return new ColorStructureLangResource($colorStructureLang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\ColorStructure\StoreColorStructureLang  $request
     * @param  \AvisoNavAPI\ColorStructure $colorStructure
     * @param  \AvisoNavAPI\ColorStructureLang $colorStructureLang
     * @return \AvisoNavAPI\Http\Resources\ColorStructureLangResource
     */
    public function update(StoreColorStructureLang $request, ColorStructure $colorStructure, ColorStructureLang $colorStructureLang)
    {
        $colorStructureLang->fill($request->only(['name']));
        $colorStructureLang->language_id = $request->input('language');
        
        if($colorStructureLang->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        }

        $colorStructureLang->save();

        return new ColorStructureLangResource($colorStructureLang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\ColorStructure $colorStructure
     * @param  \AvisoNavAPI\ColorStructureLang $colorStructureLang
     * @return \AvisoNavAPI\Http\Resources\ColorStructureLangResource
     */
    public function destroy(ColorStructure $colorStructure, ColorStructureLang $colorStructureLang)
    {
        $colorStructureLang->delete();

        return new ColorStructureLangResource($colorStructureLang);
    }

}
