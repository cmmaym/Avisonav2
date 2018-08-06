<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\NoticeLang;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\ModelFilters\Basic\NoticeLangFilter;
use AvisoNavAPI\Http\Requests\Notice\StoreNoticeLang;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Notice;
use AvisoNavAPI\Http\Resources\Notice\NoticeLangResource;

class NoticeLangController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Notice $notice)
    {
        $collection = $notice->noticeLangs()->filter(request()->all(), NoticeLangFilter::class)
                                           ->paginateFilter($this->perPage());

        return NoticeLangResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoticeLang $request, Notice $notice)
    {
        $noticeLang = new NoticeLang($request->only(['description']));
        $noticeLang->language_id = $request->input('language');
        
        $notice->noticeLang()->save($noticeLang);

        return new NoticeLangResource($noticeLang);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($notice, NoticeLang $noticeLang)
    {
         return new NoticeLangResource($noticeLang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreNoticeLang $request, $notice, NoticeLang $noticeLang)
    {
        $noticeLang->fill($request->only(['description']));
        $noticeLang->language_id = $request->input('language');

        if($noticeLang->isClean()){
            return $this->errorResponse('Debe especificar por lo menos un valor diferente para actualizar', 409);
        }
        
        $noticeLang->save();

        return new NoticeLangResource($noticeLang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($notice, NoticeLang $noticeLang)
    {
        $noticeLang->delete();

        return new NoticeLangResource($noticeLang);
    }
}
