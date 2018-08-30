<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\NoveltyLang;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\ModelFilters\Basic\NoveltyLangFilter;
use AvisoNavAPI\Http\Requests\Notice\StoreNoveltyLang;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Novelty;
use AvisoNavAPI\Http\Resources\Notice\NoveltyLangResource;

class NoveltyLangController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Novelty $novelty)
    {
        $collection = $novelty->noveltyLangs()->filter(request()->all(), NoveltyLangFilter::class)
                                           ->paginateFilter($this->perPage());

        return NoveltyLangResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoveltyLang $request, Novelty $novelty)
    {
        $noveltyLang = new NoveltyLang($request->only(['description']));
        $noveltyLang->language_id = $request->input('language');
        
        $novelty->noveltyLangs()->save($noveltyLang);

        return new NoveltyLangResource($noveltyLang);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($novelty, NoveltyLang $noveltyLang)
    {
         return new NoveltyLangResource($noveltyLang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreNoveltyLang $request, $novelty, NoveltyLang $noveltyLang)
    {
        $noveltyLang->fill($request->only(['description']));
        $noveltyLang->language_id = $request->input('language');

        if($noveltyLang->isClean()){
            return $this->errorResponse('Debe especificar por lo menos un valor diferente para actualizar', 409);
        }
        
        $noveltyLang->save();

        return new NoveltyLangResource($noveltyLang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($novelty, NoveltyLang $noveltyLang)
    {
        $noveltyLang->delete();

        return new NoveltyLangResource($noveltyLang);
    }
}
