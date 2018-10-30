<?php

namespace AvisoNavAPI\Http\Controllers\TopMark;

use AvisoNavAPI\TopMark;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Facades\Storage;
use AvisoNavAPI\Http\Requests\TopMark\StoreTopMarkImage;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

class TopMarkImageController extends Controller
{
    use Responser;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TopMark $topMark)
    {
        $fileUpload = $request->file('file');

        $extension = $fileUpload->getClientOriginalExtension();
        $path = $fileUpload->storeAs('top_mark_images', uniqid().'.'.$extension, 'public');

        $topMark->illustration = $path;
        $topMark->save();

        return $path;
    }
}