<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Aid;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Resources\Aid\SequenceFlashesResource;
use AvisoNavAPI\Http\Requests\SequenceFlashes\StoreSequenceFlashes;
use AvisoNavAPI\SequenceFlashes;
use AvisoNavAPI\Traits\Responser;

class AidSequenceFlashesController extends Controller
{
    use Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Aid\CoordinateResource
     */
    public function index(Aid $aid)
    {
        $collection = $aid->sequenceFlashes;

        return SequenceFlashesResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\SequenceFlashes\StoreSequenceFlashes  $request
     * @return \AvisoNavAPI\Http\Resources\Aid\SequenceFlashesResource
     */
    public function store(StoreSequenceFlashes $request, Aid $aid)
    {
        $sequenceFlashes = new SequenceFlashes($request->only(['on', 'off']));

        $aid->sequenceFlashes()->save($sequenceFlashes);

        return new SequenceFlashesResource($sequenceFlashes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Aid $aid
     * @param  int $id
     * @return \AvisoNavAPI\Http\Resources\Aid\SequenceFlashesResource
     */
    public function show(Aid $aid, $id)
    {
        $sequenceFlashes = $aid->sequenceFlashes()->findOrFail($id);

        return new SequenceFlashesResource($sequenceFlashes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\SequenceFlashes\StoreSequenceFlashes  $request
     * @param  \AvisoNavAPI\Aid $aid
     * @param  int  $id
     * @return \AvisoNavAPI\Http\Resources\Aid\SequenceFlashesResource
     */
    public function update(StoreSequenceFlashes $request, Aid $aid, $id)
    {
        $sequenceFlashes = $aid->sequenceFlashes()->findOrFail($id);
        $sequenceFlashes->fill($request->only(['on', 'off']));

        if($sequenceFlashes->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        }

        $sequenceFlashes->save();

        return new SequenceFlashesResource($sequenceFlashes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Aid $aid
     * @param  int  $id
     * @return \AvisoNavAPI\Http\Resources\Aid\CoordinateResource
     */
    public function destroy(Aid $aid, $id)
    {
        $sequenceFlashes = $aid->sequenceFlashes()->findOrFail($id);

        $sequenceFlashes->delete();

        return new SequenceFlashesResource($sequenceFlashes);
    }
}
