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
use AvisoNavAPI\Http\Requests\Image\StoreImage;

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
    public function store(StoreImage $request)
    {
        $name = $request->input('name');
        $fileUpload = $request->file('image');

        $fileName = str_slug($name, '-').'-'.uniqid();
        $extension = $fileUpload->getClientOriginalExtension();
        $path = $fileUpload->storeAs('images', $fileName.'.'.$extension, 'public');

        $image = new Image();
        $image->name = $name;
        $image->image = $path;

        $image->save();

        return new ImageResource($image);
    }

    public function show(Image $image)
    {
        return new ImageResource($image);
    }

    public function getImage($imageId)
    {
        $image = Image::findOrFail($imageId);

        if($image->image)
        {
            $path = public_path()."/storage/".$image->image;
            
            return response()->download($path);
        }
    }

    public function update(StoreImage $request, $imageId)
    {
        $image = Image::findOrFail($imageId);

        if($image->image)
        {
            Storage::disk('public')->delete($image->image);
        }

        $name = $request->input('name');
        $fileUpload = $request->file('image');

        $fileName = str_slug($name, '-').'-'.uniqid();
        $extension = $fileUpload->getClientOriginalExtension();
        $path = $fileUpload->storeAs('images', $fileName.'.'.$extension, 'public');

        $image->name = $name;
        $image->image = $path;

        $image->save();

        return new ImageResource($image);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $image->delete();

        Storage::disk('public')->delete($image->image);

        return new ImageResource($image);
    }
}
