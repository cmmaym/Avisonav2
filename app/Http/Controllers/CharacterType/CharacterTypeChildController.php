<?php

namespace AvisoNavAPI\Http\Controllers\CharacterType;

use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\CharacterType;
use AvisoNavAPI\ModelFilters\Basic\CharacterTypeFilter;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Resources\CharacterTypeResource;
use AvisoNavAPI\Http\Requests\CharacterType\StoreCharacterType;

class CharacterTypeChildController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CharacterType $characterType)
    {
        $collection = $characterType->characterType()->filter(request()->all(), CharacterTypeFilter::class)->paginateFilter($this->perPage());

        return CharacterTypeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCharacterType $request, CharacterType $characterType)
    {
        $this->validateChildLanguage($characterType->language_id);

        $childCaracterType = new CharacterType($request->only(['name', 'state']));
        $childCaracterType->language_id = $request->input('language_id');

        $characterType->characterType()->save($childCaracterType);

        return new CharacterTypeResource($childCaracterType);
    }

}
