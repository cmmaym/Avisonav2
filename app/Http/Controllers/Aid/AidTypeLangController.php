<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use AvisoNavAPI\AidType;
use AvisoNavAPI\AidTypeLang;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Requests\Aid\StoreAidTypeLang;
use AvisoNavAPI\ModelFilters\Basic\AidTypeLangFilter;
use AvisoNavAPI\Http\Resources\Aid\AidTypeLangResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

class AidTypeLangController extends Controller
{
    use Filter, Responser;
    
    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeLangResource
     */
    public function index(AidType $aidType)
    {
        $collection = $aidType->aidTypeLangs()->filter(request()->all(), AidTypeLangFilter::class)
                                              ->with(['aidType'])
                                              ->paginateFilter($this->perPage());

        return AidTypeLangResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Aid\StoreAidTypeLang  $request
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeLangResource
     */
    public function store(StoreAidTypeLang $request, AidType $aidType)
    {
        $aidTypeLang = new AidTypeLang($request->only('name'));
        $aidTypeLang->language_id = $request->input('language');
        
        $aidType->aidTypeLangs()->save($aidTypeLang);

        return new AidTypeLangResource($aidTypeLang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\AidType $aidType
     * @param  \AvisoNavAPI\AidTypeLang $aidTypeLang
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeLangResource
     */
    public function show(AidType $aidType, AidTypeLang $aidTypeLang)
    {
        return new AidTypeLangResource($aidTypeLang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Aid\StoreAidTypeLang  $request
     * @param  \AvisoNavAPI\AidType $aidType
     * @param  \AvisoNavAPI\AidTypeLang $aidTypeLang
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeLangResource
     */
    public function update(StoreAidTypeLang $request, AidType $aidType, AidTypeLang $aidTypeLang)
    {
        $aidTypeLang->fill($request->only(['name']));
        $aidTypeLang->language_id = $request->input('language');

        if($aidTypeLang->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        }

        $aidTypeLang->save();

        return new AidTypeLangResource($aidTypeLang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\AidType $aidType
     * @param  \AvisoNavAPI\AidTypeLang $aidTypeLang
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeLangResource
     */
    public function destroy(AidType $aidType, AidTypeLang $aidTypeLang)
    {
        $aidTypeLang->delete();

        return new AidTypeLangResource($aidTypeLang);
    }
}
