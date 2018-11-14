<?php

namespace AvisoNavAPI\Http\Controllers\Danger;

use AvisoNavAPI\Symbol;
use AvisoNavAPI\SymbolLang;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\ModelFilters\Basic\DangerLangFilter;
use AvisoNavAPI\Http\Requests\Danger\StoreDangerLang;
use AvisoNavAPI\Http\Resources\Danger\DangerLangResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

class DangerLangController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Danger\DangerLangResource
     */
    public function index($symbolId)
    {
        $symbol = Symbol::findOrFail($symbolId);

        $collection = $symbol->symbolLangs()->filter(request()->all(), DangerLangFilter::class)
                                       ->paginateFilter($this->perPage());

        return DangerLangResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Danger\StoreDangerLang  $request
     * @param  int $symbolId
     * @return \AvisoNavAPI\Http\Resources\Danger\DangerLangResource
     */
    public function store(StoreDangerLang $request, $symbolId)
    {
        $symbol = Symbol::findOrFail($symbolId);

        $symbolLang = new SymbolLang($request->only(['name']));
        $symbolLang->observation = ($request->input('observation')) ? $request->input('observation') : null;
        $symbolLang->language_id = $request->input('language');
        
        $symbol->symbolLangs()->save($symbolLang);

        return new DangerLangResource($symbolLang);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $symbolId
     * @param  int $symbolLangId
     * @return \AvisoNavAPI\Http\Resources\Danger\DangerLangResource
     */
    public function show($symbolId, $symbolLangId)
    {
        $symbolLang = SymbolLang::findOrFail($symbolLangId);
        
        return new SymbolLangResource($symbolLang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Danger\StoreDangerLang  $request
     * @param  int $symbolId
     * @param  int $symbolLangId
     * @return \AvisoNavAPI\Http\Resources\Danger\DangerLangResource
     */
    public function update(StoreDangerLang $request, $symbolId, $symbolLangId)
    {
        $symbolLang = SymbolLang::findOrFail($symbolLangId);
        $symbolLang->fill($request->only(['name']));
        $symbolLang->observation = ($request->input('observation')) ? $request->input('observation') : null;
        $symbolLang->language_id = $request->input('language');

        $symbolLang->save();

        return new DangerLangResource($symbolLang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $symbolId
     * @param  int $symbolLangId
     * @return \AvisoNavAPI\Http\Resources\Danger\DangerLangResource
     */
    public function destroy($symbolId, $symbolLangId)
    {
        $symbolLang = SymbolLang::findOrFail($symbolLangId);
        $symbolLang->delete();

        return new DangerLangResource($symbolLang);
    }
}
