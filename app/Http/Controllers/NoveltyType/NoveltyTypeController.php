<?php

namespace AvisoNavAPI\Http\Controllers\NoveltyType;

use AvisoNavAPI\NoveltyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\NoveltyTypeResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use AvisoNavAPI\Http\Requests\NoveltyType\StoreNoveltyType;
use AvisoNavAPI\Http\Requests\NoveltyType\UpdateNoveltyType;
use AvisoNavAPI\ModelFilters\Basic\NoveltyTypeFilter;
use AvisoNavAPI\Traits\Filter;

class NoveltyTypeController extends Controller
{
    use Filter;
    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\NoveltyTypeResource
     */
    public function index()
    {        
        $collection = NoveltyType::where('parent_id', null)->filter(request()->all(), NoveltyTypeFilter::class)->paginateFilter($this->perPage());

        return NoveltyTypeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\NoveltyType\StoreNoveltyType  $request
     * @return \AvisoNavAPI\Http\Resources\NoveltyTypeResource
     */
    public function store(StoreNoveltyType $request)
    {        
        $noveltyType = new NoveltyType($request->only(['name','state']));
        $noveltyType->language_id = $request->input('language_id');
        $noveltyType->save();
        
        return new NoveltyTypeResource($noveltyType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\NoveltyType  NoveltyType
     * @return \AvisoNavAPI\Http\Resources\NoveltyTypeResource
     */
    public function show(NoveltyType $noveltyType)
    {        
        return new NoveltyTypeResource($noveltyType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\NoveltyType\StoreNoveltyType  $request
     * @param  \AvisoNavAPI\NoveltyType    NoveltyType
     * @return \AvisoNavAPI\Http\Resources\NoveltyTypeResource
     */
    public function update(StoreNoveltyType $request, NoveltyType $noveltyType)
    {        
        $noveltyType->fill($request->only(['name','state']));

        //Si es un subNoveltyType validamos que no puedan cambiar su idioma
        //por el mismo idioma que tenga el su parent
        if(!is_null($noveltyType->parent_id)){
            $parent = $noveltyType->parent;
            if($language_id = $request->input('language_id') != $parent->language_id){
                $noveltyType->language_id = $language_id;
            }
        }
        
        if($noveltyType->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }
        
        $noveltyType->save();

       return new NoveltyTypeResource($noveltyType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\NoveltyType    NoveltyType
     * @return \AvisoNavAPI\Http\Resources\NoveltyTypeResource
     */
    public function destroy(Request $request, NoveltyType $noveltyType)
    {        
        $noveltyType->delete();

        return new NoveltyTypeResource($noveltyType);
    }
}