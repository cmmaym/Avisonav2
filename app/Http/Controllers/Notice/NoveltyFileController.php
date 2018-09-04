<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use AvisoNavAPI\Novelty;
use AvisoNavAPI\NoveltyFile;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Facades\Storage;
use AvisoNavAPI\ModelFilters\Basic\NoveltyFileFilter;
use AvisoNavAPI\Http\Requests\Notice\StoreNoveltyFile;
use AvisoNavAPI\Http\Resources\Notice\NoveltyFileResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

class NoveltyFileController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Novelty $novelty)
    {
        $collection = $novelty->noveltyFile()->filter(request()->all(), NoveltyFileFilter::class)
                                           ->paginateFilter($this->perPage());

        return NoveltyFileResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoveltyFile $request, Novelty $novelty)
    {
        $name = $request->input('name');
        $fileUpload = $request->file('file');

        $fileName = str_slug($name, '-').'-'.uniqid();
        $extension = $fileUpload->getClientOriginalExtension();
        $path = $fileUpload->storeAs('notice-files', $fileName.'.'.$extension, 'public');

        $noveltyFile = new NoveltyFile();
        $noveltyFile->name = $name;
        $noveltyFile->path = $path;

        $novelty->noveltyFile()->save($noveltyFile);

        return new NoveltyFileResource($noveltyFile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Novelty $novelty, $noveltyFileId)
    {

        $noveltyFile = $novelty->noveltyFile()->findOrFail($noveltyFileId);

        $noveltyFile->delete();

        Storage::disk('public')->delete($noveltyFile->path);

        return new NoveltyFileResource($noveltyFile);
    }
}
