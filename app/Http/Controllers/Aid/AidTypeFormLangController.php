<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use AvisoNavAPI\AidTypeForm;
use AvisoNavAPI\AidTypeFormLang;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Requests\Aid\StoreAidTypeFormLang;
use AvisoNavAPI\ModelFilters\Basic\AidTypeFormLangFilter;
use AvisoNavAPI\Http\Resources\Aid\AidTypeFormLangResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

class AidTypeFormLangController extends Controller
{
    use Filter, Responser;
    
    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeFormLangResource
     */
    public function index(AidTypeForm $aidTypeForm)
    {
        $collection = $aidTypeForm->aidTypeFormLangs()->filter(request()->all(), AidTypeFormLangFilter::class)
                                              ->with(['aidTypeForm'])
                                              ->paginateFilter($this->perPage());

        return AidTypeFormLangResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Aid\StoreAidTypeFormLang  $request
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeFormLangResource
     */
    public function store(StoreAidTypeFormLang $request, AidTypeForm $aidTypeForm)
    {
        $aidTypeFormLang = new AidTypeFormLang($request->only('description'));
        $aidTypeFormLang->language_id = $request->input('language');
        
        $aidTypeForm->aidTypeFormLangs()->save($aidTypeLang);

        return new AidTypeFormLangResource($aidTypeFormLang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\AidTypeForm $aidTypeForm
     * @param  \AvisoNavAPI\AidTypeFormLang $aidTypeFormLang
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeFormLangResource
     */
    public function show(AidTypeForm $aidTypeForm, AidTypeFormLang $aidTypeFormLang)
    {
        return new AidTypeFormLangResource($aidTypeFormLang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Aid\StoreAidTypeFormLang  $request
     * @param  \AvisoNavAPI\AidTypeForm $aidTypeForm
     * @param  \AvisoNavAPI\AidTypeFormLang $aidTypeFormLang
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeFormLangResource
     */
    public function update(StoreAidTypeFormLang $request, AidTypeForm $aidTypeForm, AidTypeFormLang $aidTypeFormLang)
    {
        $aidTypeFormLang->fill($request->only(['name']));
        $aidTypeFormLang->language_id = $request->input('language');

        if($aidTypeFormLang->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        }

        $aidTypeFormLang->save();

        return new AidTypeFormLangResource($aidTypeFormLang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\AidTypeForm $aidTypeForm
     * @param  \AvisoNavAPI\AidTypeFormLang $aidTypeFormLang
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeFormLangResource
     */
    public function destroy(AidTypeForm $aidTypeForm, AidTypeFormLang $aidTypeFormLang)
    {
        $aidTypeFormLang->delete();

        return new AidTypeFormLangResource($aidTypeFormLang);
    }
}
