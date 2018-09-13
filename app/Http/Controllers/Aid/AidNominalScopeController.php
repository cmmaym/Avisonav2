<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use AvisoNavAPI\Aid;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\Http\Resources\NominalScopeResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Requests\NominalScope\StoreNominalScope;
use AvisoNavAPI\Traits\Observable;
use AvisoNavAPI\NominalScope;

class AidNominalScopeController extends Controller
{
    use Filter, Responser, Observable;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\NominalScopeResource
     */
    public function index(Aid $aid)
    {
        $collection = $aid->nominalScopeCollection()->paginate($this->perPage());

        return NominalScopeResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\NominalScope\StoreNominalScope  $request
     * @param  \AvisoNavAPI\Aid $aid
     * @return \AvisoNavAPI\Http\Resources\NominalScopeResource
     */
    public function store(StoreNominalScope $request, Aid $aid)
    {
        $lastNominalScope = $aid->nominalScope;

        $nominalScope = new NominalScope();
        $nominalScope->scope = $request->input('scope');
        $nominalScope->state = 'C';
        
        $aid->nominalScope()->save($nominalScope);

        if($lastNominalScope)
        {
            $lastNominalScope->state = 'A';
            $lastNominalScope->save();
        }

        return new NominalScopeResource($nominalScope);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\NominalScope\StoreNominalScope  $request
     * @param  \AvisoNavAPI\Aid $aid
     * @param  int  $id
     * @return \AvisoNavAPI\Http\Resources\NominalScopeResource
     */
    public function update(StoreNominalScope $request, Aid $aid, $id)
    {
        $nominalScope = $aid->nominalScope()->findOrFail($id);
        $nominalScope->scope = $request->input('scope');

        if($nominalScope->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        }

        $nominalScope->save();

        return new NominalScopeResource($nominalScope);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Aid $aid
     * @param  int  $id
     * @return \AvisoNavAPI\Http\Resources\NominalScopeResource
     */
    public function destroy(Aid $aid, $id)
    {
        $nominalScope = $aid->nominalScope()->findOrFail($id);

        $nominalScope->delete();

        $currentNominalScope = $aid->nominalScopeCollection()->first();

        if($currentNominalScope)
        {
            $currentNominalScope->state = 'C';
            $currentNominalScope->save();
        }

        return new NominalScopeResource($nominalScope);
    }
}
