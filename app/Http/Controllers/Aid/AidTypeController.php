<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use AvisoNavAPI\AidType;
use AvisoNavAPI\Language;
use AvisoNavAPI\AidTypeLang;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Requests\Aid\StoreAidType;
use AvisoNavAPI\ModelFilters\Basic\AidTypeFilter;
use AvisoNavAPI\Http\Resources\Aid\AidTypeResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

class AidTypeController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeResource
     */
    public function index()
    {
        $collection = AidType::filter(request()->all(), AidTypeFilter::class)
                             ->with([
                                 'aidTypeLang' => $this->withLanguageQuery()
                             ])
                             ->paginateFilter($this->perPage());

        return AidTypeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Aid\StoreAidType  $request
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeResource
     */
    public function store(StoreAidType $request)
    {
        $language = Language::where('code','es')->firstOrFail();

        $aidType = new AidType();
        $aidType->save();

        $aidTypeLang = new AidTypeLang($request->only(['name']));
        $aidTypeLang->language_id = $language->id;

        $aidType->aidTypeLang()->save($aidTypeLang);

        return new AidTypeResource($aidType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\AidType  $aidType
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeResource
     */
    public function show(AidType $aidType)
    {
        $aidType->load([
            'aidTypeLang' => $this->withLanguageQuery()
        ]);

        return new AidTypeResource($aidType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\AidType $aidType
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeResource
     */
    public function destroy(AidType $aidType)
    {
        $aidType->delete();

        return new AidTypeResource($aidType);
    }
}
