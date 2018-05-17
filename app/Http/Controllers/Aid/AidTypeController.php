<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\AidType;
use AvisoNavAPI\ModelFilters\Basic\AidTypeFilter;
use AvisoNavAPI\Http\Resources\Aid\AidTypeResource;
use AvisoNavAPI\Http\Requests\Aid\StoreAidType;

class AidTypeController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeResource
     */
    public function index()
    {
        $language = request()->input('language');
        $collection = AidType::filter(request()->all(), AidTypeFilter::class)
                             ->with([
                                 'aidTypeLang' => function($query) use ($language){
                                     $query->where('language_id', $language);
                                 }
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
        $aidType = new AidType($request->only(['type']));
        $aidType->save();

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
        return new AidTypeResource($aidType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Aid\StoreAidType  $request
     * @param  \AvisoNavAPI\AidType $aidType
     * @return \AvisoNavAPI\Http\Resources\Aid\AidTypeResource
     */
    public function update(StoreAidType $request, AidType $aidType)
    {
        $aidType->fill($request->only(['type', 'state']));

        if($aidType->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }

        $aidType->save();

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
