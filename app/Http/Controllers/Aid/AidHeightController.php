<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use AvisoNavAPI\Aid;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Resources\HeightResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Requests\Height\StoreHeight;
use AvisoNavAPI\Height;
use AvisoNavAPI\Traits\Observable;

class AidHeightController extends Controller
{
    use Filter, Responser, Observable;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\HeightResource
     */
    public function index(Aid $aid)
    {
        $collection = $aid->heightCollection()->paginate($this->perPage());

        return HeightResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Height\StoreHeight  $request
     * @param  \AvisoNavAPI\Aid $aid
     * @return \AvisoNavAPI\Http\Resources\HeightResource
     */
    public function store(StoreHeight $request, Aid $aid)
    {
        $lastHeight = $aid->height;

        $height = new Height();
        $height->structure_height = $request->input('structureHeight');
        $height->elevation = $request->input('elevation');
        $height->state = 'C';
        
        $aid->height()->save($height);

        if($lastHeight)
        {
            $lastHeight->state = 'A';
            $lastHeight->save();
        }

        return new HeightResource($height);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Height\StoreHeight  $request
     * @param  \AvisoNavAPI\Aid $aid
     * @param  int  $id
     * @return \AvisoNavAPI\Http\Resources\HeightResource
     */
    public function update(StoreHeight $request, Aid $aid, $id)
    {
        $height = $aid->height()->findOrFail($id);
        $height->structure_height = $request->input('structureHeight');
        $height->elevation = $request->input('elevation');

        if($height->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        }

        $height->save();

        return new HeightResource($height);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Aid $aid
     * @param  int  $id
     * @return \AvisoNavAPI\Http\Resources\HeightResource
     */
    public function destroy(Aid $aid, $id)
    {
        $height = $aid->height()->findOrFail($id);

        $height->delete();

        $currentHeight = $aid->heightCollection()->first();

        if($currentHeight)
        {
            $currentHeight->state = 'C';
            $currentHeight->save();
        }

        return new HeightResource($height);
    }
}
