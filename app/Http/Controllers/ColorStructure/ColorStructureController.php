<?php

namespace AvisoNavAPI\Http\Controllers\ColorStructure;

use AvisoNavAPI\ColorStructure;
use AvisoNavAPI\ColorStructureLang;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\ColorStructure\ColorStructureResource;
use AvisoNavAPI\ModelFilters\Basic\ColorStructureFilter;
use AvisoNavAPI\Http\Requests\ColorStructure\StoreColorStructure;
use AvisoNavAPI\ModelFilters\Basic\ColorStructureLangFilter;
use AvisoNavAPI\Traits\Responser;

class ColorStructureController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\ColorStructureLangResource
     */
    public function index()
    {
        $collection = ColorStructure::filter(request()->all(), ColorStructureFilter::class)
                               ->with([
                                   'colorStructureLang' => $this->withLanguageQuery()
                                ])
                               ->paginateFilter($this->perPage());

        return ColorStructureResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\ColorStructure\StoreColorStructure  $request
     * @return \AvisoNavAPI\Http\Resources\ColorStructureResource
     */
    public function store(StoreColorStructure $request)
    {
        $colorStructure = new ColorStructure();
        $colorStructure->save();

        $colorStructureLang = new ColorStructureLang($request->only(['name']));
        $colorStructureLang->language_id = $request->input('language');

        $colorStructure->colorStructureLangs()->save($colorStructureLang);
        
        return new ColorStructureResource($colorStructure);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\ColorStructure  $ColorStructure
     * @return \AvisoNavAPI\Http\Resources\ColorStructureResource
     */
    public function show(ColorStructure $colorStructure)
    {
        $colorStructure->load([
            'colorStructureLang' => $this->withLanguageQuery()
        ]);

        return new ColorStructureResource($colorStructure);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\ColorStructure $ColorStructure
     * @return \AvisoNavAPI\Http\Resources\ColorStructureResource
     */
    public function destroy(ColorStructure $colorStructure)
    {
        $colorStructure->delete();

        return new ColorStructureResource($colorStructure);
    }

}
