<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use AvisoNavAPI\Notice;
use AvisoNavAPI\AvisoDetalle;
use AvisoNavAPI\Http\Requests\Notice\StoreNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\NoticeResource;
use AvisoNavAPI\Http\Resources\AyudaResource;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\ModelFilters\Basic\NoticeFilter;

class NoticeController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $collection = Notice::filter(request()->all(), NoticeFilter::class)
                            ->paginateFilter($this->perPage());

        return NoticeResource::collection($collection);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotice $request)
    {
        $notice = new Notice($request->only(['number', 'date', 'state']));
        
        
        $periodo = (new \DateTime("now"))->format('Ym');
        $notice->periodo = $periodo;
        $notice->user = 'JMARDZ';
        $notice->entity_id = $request->input('entity_id');

        $notice->parent_id = ($request->has('parent_id')) ? $request->input('parent_id') : null;
        
        // $notice->file_info = null;

        $notice->save();

        return new NoticeResource($notice);

    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice)
    {
        return new NoticeResource($notice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \AvisoNavAPI\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(StoreNotice $request, Notice $notice)
    {
        $notice->fill($request->only(['number', 'date', 'state']));
        $notice->user = 'JMARDZ';
        $notice->entity_id = $request->input('entity_id');

        $notice->parent_id = ($request->has('parent_id')) ? $request->input('parent_id') : null;

        if($notice->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }
        
        $notice->save();

        return new NoticeResource($notice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {
        $notice->delete();

        return new NoticeResource($notice);
    }
}
