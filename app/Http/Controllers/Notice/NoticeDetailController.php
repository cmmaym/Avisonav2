<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\NoticeDetail;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\ModelFilters\Basic\NoticeDetailFilter;
use AvisoNavAPI\Http\Requests\Notice\StoreNoticeDetail;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Notice;
use AvisoNavAPI\Http\Resources\NoticeDetailResource;

class NoticeDetailController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Notice $notice)
    {
        $collection = $notice->noticeDetail()->filter(request()->all(), NoticeDetailFilter::class)->paginateFilter($this->perPage());

        return NoticeDetailResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoticeDetail $request, Notice $notice)
    {
        $noticeDetail = new NoticeDetail($request->only(['observation', 'state']));
        $noticeDetail->character_type_id = $request->input('character_type_id');
        $noticeDetail->language_id = $request->input('language_id');
        
        $notice->noticeDetail()->save($noticeDetail);

        return new NoticeDetailResource($noticeDetail);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice, $noticeDetail)
    {
        dd($noticeDetail);
        // return new NoticeDetailResource($noticeDetail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
