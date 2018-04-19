<?php

namespace AvisoNavAPI\Http\Controllers\CharacterType;

use AvisoNavAPI\CharacterType;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\CharacterTypeResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use AvisoNavAPI\Http\Requests\CharacterType\StoreCharacterType;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\ModelFilters\Basic\CharacterTypeFilter;

class CharacterTypeController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\CharacterTypeResource
     */
    public function index()
    {
        $collection = CharacterType::where('parent_id', null)->filter(request()->all(), CharacterTypeFilter::class)->paginateFilter($this->perPage());

        return CharacterTypeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\TipoCaracter\StoreCharacterType  $request
     * @return \AvisoNavAPI\Http\Resources\CharacterTypeResource
     */
    public function store(StoreCharacterType $request)
    {
        $characterType = new CharacterType($request->only(['name', 'state']));
        $characterType->language_id = $request->input('language_id');
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
     * @param  \AvisoNavAPI\Http\Requests\TipoCaracter\StoreCharacterType  $request
     * @param  \AvisoNavAPI\CharacterType $characterType
     * @return \AvisoNavAPI\Http\Resources\CharacterTypeResource
     */
    public function update(StoreCharacterType $request, CharacterType $characterType)
    {
        $characterType->fill($request->only(['name', 'state']));

        //Si es un child validamos que no puedan cambiar su idioma
        //por el mismo idioma que tenga el su parent
        if(!is_null($characterType->parent_id)){
            $parent = $characterType->parent;
            if($language_id = $request->input('language_id') != $parent->language_id){
                $characterType->language_id = $language_id;
            }
        }
        
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
