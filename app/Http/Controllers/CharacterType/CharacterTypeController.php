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

class CharacterTypeController extends Controller
{
    use Filter;

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
        $characterType = new CharacterType();
        $characterType->save();
        
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
        $characterType->fill($request->only(['state']));
        
        if($characterType->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
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
