<?php

namespace AvisoNavAPI\Http\Controllers\NoticeType;

use AvisoNavAPI\NoticeType;
use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\NoticeTypeResource;
use AvisoNavAPI\ModelFilters\Basic\NoticeTypeFilter;
use AvisoNavAPI\Http\Requests\NoticeType\StoreNoticeType;

class NoticeTypeChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NoticeType $noticeType)
    {
        $perPage = (int)request()->input('perPage') ?? 15;
        $collection = $noticeType->noticeType()->filter(request()->all(), NoticeTypeFilter::class)->paginateFilter($perPage);

        return NoticeTypeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoticeType $request, NoticeType $noticeType)
    {
        $childNoticeType = new NoticeType($request->only(['name','state']));
        $childNoticeType->language_id = $request->input('language_id');
        
        $noticeType->noticeType()->save($childNoticeType);
        
        return new NoticeTypeResource($childNoticeType);
    }

}
