<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use AvisoNavAPI\Aid;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Resources\PeriodResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Requests\Period\StorePeriod;
use AvisoNavAPI\Period;
use AvisoNavAPI\Traits\Observable;

class AidPeriodController extends Controller
{
    use Filter, Responser, Observable;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\PeriodResource
     */
    public function index(Aid $aid)
    {
        $collection = $aid->PeriodCollection()->paginate($this->perPage());

        return PeriodResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Period\StorePeriod  $request
     * @param  \AvisoNavAPI\Aid $aid
     * @return \AvisoNavAPI\Http\ResourcesPeriodtResource
     */
    public function store(StorePeriod $request, Aid $aid)
    {
        $lastPeriod = $aid->period()->where('state', '=', 'C')->first();

        $period = new Period();
        $period->time = $request->input('time');
        $period->flash_group = $request->input('flashGroup');
        $period->state = 'C';
        
        $aid->period()->save($period);

        if($lastPeriod)
        {
            $lastPeriod->state = 'A';
            $lastPeriod->save();
        }

        return new PeriodResource($period);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Period\StorePeriod  $request
     * @param  \AvisoNavAPI\Aid $aid
     * @param  int  $id
     * @return \AvisoNavAPI\Http\Resources\PeriodResource
     */
    public function update(StorePeriod $request, Aid $aid, $id)
    {
        $period = $aid->period()->findOrFail($id);
        $period->time = $request->input('time');
        $period->flash_group = $request->input('flashGroup');

        if($period->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        }

        $period->save();

        return new PeriodResource($period);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Aid $aid
     * @param  int  $id
     * @return \AvisoNavAPI\Http\Resources\PeriodResource
     */
    public function destroy(Aid $aid, $id)
    {
        $period = $aid->period()->findOrFail($id);

        $period->delete();

        $currentPeriod = $aid->periodCollection()->first();

        if($currentPeriod)
        {
            $currentPeriod->state = 'C';
            $currentPeriod->save();
        }

        return new PeriodResource($period);
    }
}
