<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use AvisoNavAPI\Aid;
// use AvisoNavAPI\AidLang;
use AvisoNavAPI\SymbolLang;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Requests\Aid\StoreAidLang;
use AvisoNavAPI\ModelFilters\Basic\AidLangFilter;
use AvisoNavAPI\Http\Resources\Aid\AidLangResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

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
        $collection = $aid->symbol->symbolLangs()->filter(request()->all(), AidLangFilter::class)
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
        $symbolLang = new SymbolLang($request->only(['name']));
        $symbolLang->observation = ($request->input('observation')) ? $request->input('observation') : null;
        $symbolLang->language_id = $request->input('language');
        
        $aid->symbol->symbolLangs()->save($symbolLang);

        return new AidLangResource($symbolLang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Aid $aid
     * @param  int $id
     * @return \AvisoNavAPI\Http\Resources\Aid\AidLangResource
     */
    public function show(Aid $aid, AidLang $aidLang)
    {
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
    public function update(StoreAidLang $request, Aid $aid, $symbolLangId)
    {
        $symbolLang = $aid->symbol->symbolLangs()->findOrFail($symbolLangId);
        $symbolLang->fill($request->only(['name']));
        $symbolLang->observation = ($request->input('observation')) ? $request->input('observation') : null;
        $symbolLang->language_id = $request->input('language');

        if($symbolLang->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        }

        $symbolLang->save();

        return new AidLangResource($symbolLang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Aid $aid
     * @param  int $id
     * @return \AvisoNavAPI\Http\Resources\Aid\AidLangResource
     */
    public function destroy(Aid $aid, $symbolLangId)
    {
        $symbolLang = $aid->symbol->symbolLangs()->findOrFail($symbolLangId);
        $symbolLang->delete();

        return new AidLangResource($symbolLang);
    }
}
