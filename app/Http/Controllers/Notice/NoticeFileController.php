<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use AvisoNavAPI\Notice;
use AvisoNavAPI\NoticeFile;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Facades\Storage;
use AvisoNavAPI\ModelFilters\Basic\NoticeFileFilter;
use AvisoNavAPI\Http\Requests\Notice\StoreNoticeFile;
use AvisoNavAPI\Http\Resources\Notice\NoticeFileResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

class NoticeFileController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Notice $notice)
    {
        $collection = $notice->noticeFile()->filter(request()->all(), NoticeFileFilter::class)
                                           ->paginateFilter($this->perPage());

        return NoticeFileResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoticeFile $request, Notice $notice)
    {
        $name = $request->input('name');
        $fileUpload = $request->file('file');

        $fileName = str_slug($name, '-').'-'.uniqid();
        $extension = $fileUpload->getClientOriginalExtension();
        $path = $fileUpload->storeAs('notice-files', $fileName.'.'.$extension, 'public');

        $noticeFile = new NoticeFile();
        $noticeFile->name = $name;
        $noticeFile->path = $path;

        $notice->noticeFile()->save($noticeFile);

        return new NoticeFileResource($noticeFile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($notice, NoticeFile $noticeFile)
    {
        $noticeFile->delete();

        Storage::disk('public')->delete($noticeFile->path);

        return new NoticeFileResource($noticeFile);
    }
}
