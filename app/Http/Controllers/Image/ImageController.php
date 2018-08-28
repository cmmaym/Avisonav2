<?php

namespace AvisoNavAPI\Http\Controllers\Image;

use AvisoNavAPI\Image;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Facades\Storage;
use AvisoNavAPI\Http\Resources\ImageResource;
use AvisoNavAPI\ModelFilters\Basic\ImageFilter;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

class ImageController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Image::filter(request()->all(), ImageFilter::class)
                                           ->paginateFilter($this->perPage());

        return ImageResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StoreNoticeFile $request, Notice $notice)
    // {
    //     $name = $request->input('name');
    //     $fileUpload = $request->file('file');

    //     $fileName = str_slug($name, '-').'-'.uniqid();
    //     $extension = $fileUpload->getClientOriginalExtension();
    //     $path = $fileUpload->storeAs('notice-files', $fileName.'.'.$extension, 'public');

    //     $noticeFile = new NoticeFile();
    //     $noticeFile->name = $name;
    //     $noticeFile->path = $path;

    //     $notice->noticeFile()->save($noticeFile);

    //     return new NoticeFileResource($noticeFile);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($notice, NoticeFile $noticeFile)
    // {
    //     $noticeFile->delete();

    //     Storage::disk('public')->delete($noticeFile->path);

    //     return new NoticeFileResource($noticeFile);
    // }
}
