<?php

namespace AvisoNavAPI\Http\Controllers\CharacterType;

use AvisoNavAPI\CharacterType;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\CharacterTypeLang;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\CharacterType\CharacterTypeLangResource;
use AvisoNavAPI\ModelFilters\Basic\CharacterTypeLangFilter;
use AvisoNavAPI\Http\Requests\CharacterType\StoreCharacterTypeLang;

class CharacterTypeLangController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @param \AvisoNavAPI\CharacterType $characterType
     * @return \AvisoNavAPI\Http\Resources\CharacterTypeLangResource
     */
    public function index(CharacterType $characterType)
    {
        $collection = $characterType->characterTypeLangs()->filter(request()->all(), CharacterTypeLangFilter::class)
                                                          ->with(['characterType'])
                                                          ->paginateFilter($this->perPage());

        return CharacterTypeLangResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \AvisoNavAPI\Http\Requests\CharacterType\StoreCharacterTypeLang $request
     * @param \AvisoNavAPI\CharacterType $characterType
     * @param \AvisoNavAPI\CharacterTypeLang $characterTypeLang
     * @return \AvisoNavAPI\Http\Resources\CharacterTypeLangResource
     */
    public function store(StoreCharacterTypeLang $request, CharacterType $characterType)
    {
        $characterTypeLang = new CharacterTypeLang($request->only(['name']));
        $characterTypeLang->language_id = $request->input('language_id');

        $characterType->characterTypeLangs()->save($characterTypeLang);

        return new CharacterTypeLangResource($characterTypeLang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\CharacterType  $characterType
     * @param  \AvisoNavAPI\CharacterTypeLang  $characterTypeLang
     * @return \AvisoNavAPI\Http\Resources\CharacterTypeLangResource
     */
    public function show(CharacterType $characterType, CharacterTypeLang $characterTypeLang)
    {
        return new CharacterTypeLangResource($characterTypeLang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\CharacterType\StoreCharacterTypeLang  $request
     * @param  \AvisoNavAPI\CharacterType $characterType
     * @param  \AvisoNavAPI\CharacterTypeLang $characterTypeLang
     * @return \AvisoNavAPI\Http\Resources\CharacterTypeLangResource
     */
    public function update(StoreCharacterTypeLang $request, CharacterType $characterType, CharacterTypeLang $characterTypeLang)
    {
        $characterTypeLang->fill($request->only(['name']));
        
        if($characterTypeLang->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }

        $characterTypeLang->save();

       return new CharacterTypeLangResource($characterTypeLang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\CharacterType $characterType
     * @param  \AvisoNavAPI\CharacterTypeLang $characterTypeLang
     * @return \AvisoNavAPI\Http\Resources\CharacterTypeLangResource
     */
    public function destroy(CharacterType $characterType, CharacterTypeLang $characterTypeLang)
    {
        $characterTypeLang->delete();

        return new CharacterTypeLangResource($characterTypeLang);
    }

}
