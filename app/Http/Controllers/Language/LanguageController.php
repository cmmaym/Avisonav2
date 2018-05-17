<?php

namespace AvisoNavAPI\Http\Controllers\Language;

use AvisoNavAPI\Language;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use \AvisoNavAPI\Http\Resources\LanguageResource;
use AvisoNavAPI\ModelFilters\Basic\LanguageFilter;
use \AvisoNavAPI\Http\Requests\Language\StoreLanguage;

class LanguageController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\LanguageResource
     */
    public function index()
    {
        $collection = Language::filter(request()->all(), LanguageFilter::class)->paginateFilter($this->perPage());

        return LanguageResource::collection($collection);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Language\StoreLanguage  $request
     * @return \AvisoNavAPI\Http\Resources\LanguageResource
     */
    public function store(StoreLanguage $request)
    {
        $language = Language::create($request->only(['name','code','state']));

        return new LanguageResource($language);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Language  $language
     * @return \AvisoNavAPI\Http\Resources\LanguageResource
     */
    public function show(Language $language)
    {
        return new LanguageResource($language);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Language\StoreLanguage  $request
     * @param  \AvisoNavAPI\Language  $language
     * @return \AvisoNavAPI\Http\Resources\LanguageResource
     */
    public function update(StoreLanguage $request, Language $language)
    {
        $language->fill($request->only(['name','code','state']));

        if($language->isClean()){            
            return $this->errorResponser('Debe espesificar por lo menos un valor diferente para actualizar', 422);
        }

        $language->save();

        return new LanguageResource($language);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Language  $language
     * @return \AvisoNavAPI\Http\Resources\LanguageResource
     */
    public function destroy(Language $language)
    {
        $language->delete();

        return new LanguageResource($language);
    }
}
