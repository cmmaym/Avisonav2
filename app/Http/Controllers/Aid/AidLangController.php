<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use AvisoNavAPI\Aid;
use AvisoNavAPI\AidLang;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Requests\Aid\StoreAidLang;
use AvisoNavAPI\Http\Resources\Aid\AidLangResource;
use AvisoNavAPI\ModelFilters\Basic\AidLangFilter;
use AvisoNavAPI\Traits\Responser;

class AidLangController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Aid\AidLangResource
     */
    public function index(Aid $aid)
    {
        $collection = $aid->aidLangs()->filter(request()->all(), AidLangFilter::class)
                                       ->with(['aid'])
                                       ->paginateFilter($this->perPage());

        return AidLangResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Aid\StoreAidLang  $request
     * @param  \AvisoNavAPI\Aid $aid
     * @return \AvisoNavAPI\Http\Resources\Aid\AidLangResource
     */
    public function store(StoreAidLang $request, Aid $aid)
    {
        $aidLang = new AidLang($request->only(['description']));
        $aidLang->language_id = $request->input('language');
        
        $aid->aidLangs()->save($aidLang);

        return new AidLangResource($aidLang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Aid $aid
     * @param  int $id
     * @return \AvisoNavAPI\Http\Resources\Aid\AidLangResource
     */
    public function show(Aid $aid, $id)
    {
        $aidLang = $aid->aidLang()->findOrFail($id);

        return new AidLangResource($aidLang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Aid\StoreAidLang  $request
     * @param  \AvisoNavAPI\Aid $aid
     * @param  int $id
     * @return \AvisoNavAPI\Http\Resources\Aid\AidLangResource
     */
    public function update(StoreAidLang $request, Aid $aid, $id)
    {
        $aidLang = $aid->aidLang()->findOrFail($id);
        $aidLang->fill($request->only(['description']));
        $aidLang->language_id = $request->input('language');

        if($aidLang->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        }

        $aidLang->save();

        return new AidLangResource($aidLang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Aid $aid
     * @param  int $id
     * @return \AvisoNavAPI\Http\Resources\Aid\AidLangResource
     */
    public function destroy(Aid $aid, $id)
    {
        $aidLang = $aid->aidLang()->findOrFail($id);
        $aidLang->delete();

        return new AidLangResource($aidLang);
    }
}
