<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use AvisoNavAPI\Notice;
use AvisoNavAPI\NoticeLang;
use Illuminate\Http\Request;
use AvisoNavAPI\AvisoDetalle;
use AvisoNavAPI\Traits\Filter;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\AyudaResource;
use AvisoNavAPI\ModelFilters\Basic\NoticeFilter;
use AvisoNavAPI\Http\Requests\Notice\StoreNotice;
use AvisoNavAPI\Http\Resources\Notice\NoticeResource;
use AvisoNavAPI\Traits\Responser;

class NoticeController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Notice::filter(request()->all(), NoticeFilter::class)
                            ->with([
                                'entity',
                                'characterType.characterTypeLang' => $this->withLanguageQuery(),
                                'noveltyType.noveltyTypeLang' => $this->withLanguageQuery(),
                                'noticeLang' => $this->withLanguageQuery(),
                                'aid'
                            ])
                            ->paginateFilter($this->perPage());

        return NoticeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Notice\StoreNotice  $request
     * @return \AvisoNavAPI\Http\Resources\NoticeResource
     */
    public function store(StoreNotice $request)
    {
        $notice = new Notice($request->only(['number']));
        
        $year = (new \DateTime("now"))->format('Y');
        $notice->year = $year;
        $notice->user = 'JMARDZ';
        $notice->entity_id = $request->input('entity');
        $notice->character_type_id = $request->input('characterType');
        $notice->novelty_type_id = $request->input('noveltyType');

        $notice->parent_id = ($request->has('parent_id')) ? $request->input('parent_id') : null;
        
        // $notice->file_info = null;

        $notice->save();

        $noticeLang = new NoticeLang();
        $noticeLang->observation = $request->input('observation');
        $noticeLang->language_id = $request->input('language');

        $notice->noticeLang()->save($noticeLang);
        
        $notice->refresh();

        return new NoticeResource($notice);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Notice  $notice
     * @return \AvisoNavAPI\Http\Resources\NoticeResource
     */
    public function show(Notice $notice)
    {
        $notice->load([
            'entity',
            'characterType.characterTypeLang' => $this->withLanguageQuery(),
            'noveltyType.noveltyTypeLang' => $this->withLanguageQuery(),
            'noticeLang' => $this->withLanguageQuery(),
        ]);

        return new NoticeResource($notice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Notice\StoreNotice  $request
     * @param  \AvisoNavAPI\Notice  $notice
     * @return \AvisoNavAPI\Http\Resources\NoticeResource
     */
    public function update(StoreNotice $request, Notice $notice)
    {
        $notice->fill($request->only(['number', 'state']));
        $notice->user = 'JMARDZ';
        $notice->entity_id = $request->input('entity');
        $notice->character_type_id = $request->input('characterType');
        $notice->novelty_type_id = $request->input('noveltyType');

        $notice->parent_id = ($request->has('parent_id')) ? $request->input('parent_id') : null;

        if($notice->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        }
        
        $notice->save();

        return new NoticeResource($notice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Notice  $notice
     * @return \AvisoNavAPI\Http\Resources\NoticeResource
     */
    public function destroy(Notice $notice)
    {
        $notice->delete();

        return new NoticeResource($notice);
    }
}
