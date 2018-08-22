<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use AvisoNavAPI\Notice;
use AvisoNavAPI\Novelty;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Requests\Notice\StoreNovelty;
use AvisoNavAPI\Http\Resources\Notice\NoveltyResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\ModelFilters\Basic\NoveltyFilter;

class NoticeNoveltyController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Notice\NoveltyResource
     */
    public function index(Notice $notice)
    {
       $collection = $notice->novelty()->filter(request()->all(), NoveltyFilter::class)
                                       ->with([
                                            'characterType.characterTypeLang' => $this->withLanguageQuery(),
                                            'noveltyType.noveltyTypeLang' => $this->withLanguageQuery(),
                                       ])
                                       ->paginateFilter($this->perPage());

        return NoveltyResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Notice\StoreNovelty  $request
     * @return \AvisoNavAPI\Http\Resources\NoveltyResource
     */
    public function store(StoreNovelty $request, Notice $notice)
    {
        $novelty = new Novelty();
        $novelty->novelty_type = $request->input('noveltyType');
        $novelty->character_type = $request->input('characterType');

        $notice->novelty()->save($novelty);

        return new NoveltyResource($novelty);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Notice  $notice
     * @param  int  $novelty
     * @return \AvisoNavAPI\Http\Resources\NoveltyResource
     */
    public function show(Notice $notice, $noveltyId)
    {
        $novelty = $notice->findOrFail($noveltyId);

        $novelty->load([
            'characterType.characterTypeLang' => $this->withLanguageQuery(),
            'noveltyType.noveltyTypeLang' => $this->withLanguageQuery(),
        ]);

        return new NoveltyResource($novelty);
    }

    /**
     * Update the specified resource in storage.
     * @param  \AvisoNavAPI\Http\Requests\Notice\StoreNovelty  $request
     * @param  \AvisoNavAPI\Notice $notice
     * @param  int $novelty
     * @return \AvisoNavAPI\Http\Resources\NoveltyResource
     */
    public function update(StoreNovelty $request, Notice $notice, $noveltyId)
    {
        $novelty = $notice->findOrFail($noveltyId);
        $novelty->novelty_type = $request->input('noveltyType');
        $novelty->character_type = $request->input('characterType');

        if($novelty->isClean()){
            return $this->errorResponse('Debe especificar por lo menos un valor diferente para actualizar', 409);
        }

        return new NoveltyResource($novelty);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Notice  $notice
     * @param  int  $novelty
     * @return \AvisoNavAPI\Http\Resources\NoveltyResource
     */
    public function destroy(Notice $notice, $noveltyId)
    {
        $novelty = $notice->findOrFail($noveltyId);
        $novelty->delete();

        return new NoveltyResource($novelty);
    }
}