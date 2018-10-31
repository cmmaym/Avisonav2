<?php

namespace AvisoNavAPI\Http\Controllers\TopMark;

use AvisoNavAPI\TopMark;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Facades\File;
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
    public function store(StoreTopMarkImage $request, TopMark $topMark)
    {
        $fileUpload = $request->file('image');

        if($topMark->image)
        {
            Storage::disk('public')->delete($topMark->image);
        }

        if($fileUpload)
        {
            $extension = $fileUpload->getClientOriginalExtension();
            $path = $fileUpload->storeAs('top_mark_images', uniqid().'.'.$extension, 'public');
    
            $topMark->image = $path;
            $topMark->save();
            
            return $path;
        }
        
        $topMark->image = null;
        $topMark->save();
    }

    public function show($topMarkId)
    {
        $topMark = TopMark::findOrFail($topMarkId);

        if($topMark->image)
        {
            $path = public_path()."/storage/".$topMark->image;
            
            return response()->download($path);
        }
    }
}