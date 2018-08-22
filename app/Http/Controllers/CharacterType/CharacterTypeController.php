<?php

namespace AvisoNavAPI\Http\Controllers\CharacterType;

use AvisoNavAPI\CharacterType;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\CharacterTypeLang;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\CharacterType\CharacterTypeResource;
use AvisoNavAPI\ModelFilters\Basic\CharacterTypeFilter;
use AvisoNavAPI\Http\Resources\CharacterType\CharacterTypeLangResource;
use AvisoNavAPI\ModelFilters\Basic\CharacterTypeLangFilter;
use AvisoNavAPI\Http\Requests\CharacterType\StoreCharacterType;
use AvisoNavAPI\Traits\Responser;

class CharacterTypeController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\CharacterTypeLangResource
     */
    public function index()
    {
        $collection = CharacterType::filter(request()->all(), CharacterTypeFilter::class)
                                       ->with([
                                           'characterTypeLang' => $this->withLanguageQuery()
                                        ]) 
                                       ->paginateFilter($this->perPage());

        return CharacterTypeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\CharacterType\StoreCharacterType  $request
     * @return \AvisoNavAPI\Http\Resources\CharacterTypeResource
     */
    public function store(StoreCharacterType $request)
    {
        $characterType = new CharacterType($request->only(['alias']));
        $characterType->save();

        $characterTypeLang = new CharacterTypeLang($request->only(['name']));
        $characterTypeLang->language_id = $request->input('language');

        $characterType->characterTypeLangs()->save($characterTypeLang);
        
        return new CharacterTypeResource($characterType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\CharacterType  $characterType
     * @return \AvisoNavAPI\Http\Resources\CharacterTypeResource
     */
    public function show(CharacterType $characterType)
    {
        $characterType->load([
            'characterTypeLang' => $this->withLanguageQuery()
        ]);

        return new CharacterTypeResource($characterType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\CharacterType\StoreCharacterType  $request
     * @param  \AvisoNavAPI\CharacterType $characterType
     * @return \AvisoNavAPI\Http\Resources\CharacterTypeResource
     */
    public function update(StoreCharacterType $request, CharacterType $characterType)
    {
        $characterType->fill($request->only(['alias']));
        
        if($characterType->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        }

        $characterType->save();

       return new CharacterTypeResource($characterType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\CharacterType $characterType
     * @return \AvisoNavAPI\Http\Resources\CharacterTypeResource
     */
    public function destroy(CharacterType $characterType)
    {
        $characterType->delete();

        return new CharacterTypeResource($characterType);
    }

}
