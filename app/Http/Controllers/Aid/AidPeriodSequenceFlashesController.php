<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Aid;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Resources\SequenceFlashesResource;
use AvisoNavAPI\Http\Requests\SequenceFlashes\StoreSequenceFlashes;
use AvisoNavAPI\SequenceFlashes;
use AvisoNavAPI\Traits\Responser;

class AidPeriodSequenceFlashesController extends Controller
{
    use Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\SequenceFlashes\StoreSequenceFlashes
     */
    public function index(Aid $aid, $periodId)
    {
        $period = $aid->period()->findOrFail($periodId);

        $collection = $period->sequenceFlashes;

        return SequenceFlashesResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\SequenceFlashes\StoreSequenceFlashes  $request
     * @param  \AvisoNavAPI\Aid $aid
     * @param  int $periodId
     * @return \AvisoNavAPI\Http\Resources\Aid\SequenceFlashesResource
     */
    public function store(StoreSequenceFlashes $request, Aid $aid, $periodId)
    {
        $period = $aid->period()->findOrFail($periodId);

        $sequenceFlashes = new SequenceFlashes($request->only(['on', 'off']));

        $period->sequenceFlashes()->save($sequenceFlashes);

        return new SequenceFlashesResource($sequenceFlashes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\SequenceFlashes\StoreSequenceFlashes  $request
     * @param  \AvisoNavAPI\Aid $aid
     * @param  int $periodId
     * @param  int  $id
     * @return \AvisoNavAPI\Http\Resources\Aid\SequenceFlashesResource
     */
    public function update(StoreSequenceFlashes $request, Aid $aid, $periodId, $id)
    {
        $period = $aid->period()->findOrFail($periodId);
        $sequenceFlashes = $period->sequenceFlashes()->findOrFail($id);
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
     * @param  int $periodId
     * @param  int  $id
     * @return \AvisoNavAPI\Http\Resources\Aid\CoordinateResource
     */
    public function destroy(Aid $aid, $periodId, $id)
    {
        $period = $aid->period()->findOrFail($periodId);
        $sequenceFlashes = $period->sequenceFlashes()->findOrFail($id);

        $sequenceFlashes->delete();

        return new SequenceFlashesResource($sequenceFlashes);
    }
}
