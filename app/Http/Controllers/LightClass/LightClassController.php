<?php

namespace AvisoNavAPI\Http\Controllers\LightClass;

use AvisoNavAPI\Language;
use AvisoNavAPI\LightClass;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\LightClassLang;
use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\ModelFilters\Basic\LightClassFilter;
use AvisoNavAPI\ModelFilters\Basic\LightClassLangFilter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use AvisoNavAPI\Http\Requests\LightClass\StoreLightClass;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\LightClass\LightClassResource;

class LightClassController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\LightClassResource
     */
    public function index()
    {
        $collection = LightClass::filter(request()->all(), LightClassFilter::class)
                                   ->with([
                                       'lightClassLang' => $this->withLanguageQuery()
                                    ]) 
                                   ->paginateFilter($this->perPage());

        return LightClassResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\LightClass\StoreLightClass  $request
     * @return \AvisoNavAPI\Http\Resources\LightClassResource
     */
    public function store(StoreLightClass $request)
    {
        $language = Language::where('code','es')->firstOrFail();

        $lightClass = new LightClass($request->only(['alias']));
        $lightClass->save();

        $lightClassLang = new LightClassLang($request->only(['class', 'description']));
        $lightClassLang->language_id = $language->id;

        $lightClass->lightClassLang()->save($lightClassLang);
        
        return new LightClassResource($lightClass); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\LightClass $lightClass
     * @return \AvisoNavAPI\Http\Resources\LightClassResource
     */
    public function show(LightClass $lightClass)
    {
        $lightClass->load([
            'lightClassLang' => $this->withLanguageQuery()
        ]);
        
        return new LightClassResource($lightClass);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\LightClass\StoreLightClass  $request
     * @param  \AvisoNavAPI\LightClass $lightClass
     * @return \AvisoNavAPI\Http\Resources\LightClassResource
     */
    public function update(StoreLightClass $request, LightClass $lightClass)
    {
        $lightClass->fill($request->only(['alias']));
        
        if($lightClass->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        }

        $lightClass->save();

        return new LightClassResource($lightClass);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\LightClass $lightClass
     * @return \AvisoNavAPI\Http\Resources\LightClassResource
     */
    public function destroy(LightClass $lightClass)
    {
        $lightClass->delete();

        return new LightClassResource($lightClass);
    }
    
}
