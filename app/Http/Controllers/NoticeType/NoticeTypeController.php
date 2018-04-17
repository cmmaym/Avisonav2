<?php

namespace AvisoNavAPI\Http\Controllers\NoticeType;

use AvisoNavAPI\NoticeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\NoticeTypeResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use AvisoNavAPI\Http\Requests\NoticeType\StoreNoticeType;
use AvisoNavAPI\Http\Requests\NoticeType\UpdateNoticeType;
use AvisoNavAPI\ModelFilters\Basic\NoticeTypeFilter;

class NoticeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\NoticeTypeResource
     */
    public function index()
    {
        $perPage = (int)request()->input('perPage') ?? 15;
        $collection = NoticeType::where('parent_id', null)->filter(request()->all(), NoticeTypeFilter::class)->paginateFilter($perPage);

        return NoticeTypeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\NoticeType\StoreNoticeType  $request
     * @return \AvisoNavAPI\Http\Resources\NoticeTypeResource
     */
    public function store(StoreNoticeType $request)
    {        
        $noticeType = new NoticeType($request->only(['name','state']));
        $noticeType->language_id = $request->input('language_id');
        $noticeType->save();
        
        return new NoticeTypeResource($noticeType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\NoticeType  NoticeType
     * @return \AvisoNavAPI\Http\Resources\NoticeTypeResource
     */
    public function show(NoticeType $noticeType)
    {        
        return new NoticeTypeResource($noticeType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\NoticeType\StoreNoticeType  $request
     * @param  \AvisoNavAPI\NoticeType    NoticeType
     * @return \AvisoNavAPI\Http\Resources\NoticeTypeResource
     */
    public function update(StoreNoticeType $request, NoticeType $noticeType)
    {        
        $noticeType->fill($request->only(['name','state']));

        //Si es un subNoticeType validamos que no puedan cambiar su idioma
        //por el mismo idioma que tenga el su parent
        if(!is_null($noticeType->parent_id)){
            $parent = $noticeType->parent;
            if($language_id = $request->input('language_id') != $parent->language_id){
                $noticeType->language_id = $language_id;
            }
        }
        
        if($noticeType->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }
        
        $noticeType->save();

       return new NoticeTypeResource($noticeType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\NoticeType    NoticeType
     * @return \AvisoNavAPI\Http\Resources\NoticeTypeResource
     */
    public function destroy(Request $request, NoticeType $noticeType)
    {        
        $noticeType->delete();

        return new NoticeTypeResource($noticeType);
    }
}