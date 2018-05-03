<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Aid;
use AvisoNavAPI\ModelFilters\Basic\CoordinateFilter;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Resources\Aid\CoordinateResource;
use AvisoNavAPI\Http\Requests\Coordinate\StoreCoordinate;
use AvisoNavAPI\Coordinate;

class AidCoordinateController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Aid\CoordinateResource
     */
    public function index(Aid $aid)
    {
        $collection = $aid->coordinates()->filter(request()->all(), CoordinateFilter::class)
                                         ->with(['aid'])
                                         ->paginateFilter($this->perPage());

        return CoordinateResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Coordinate\StoreCoordinate  $request
     * @return \AvisoNavAPI\Http\Resources\Aid\CoordinateResource
     */
    public function store(StoreCoordinate $request, Aid $aid)
    {
        $coordinate = new Coordinate($request->only(['latitud', 'longitud']));

        $aid->coordinates()->save($coordinate);

        return new CoordinateResource($coordinate);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Aid $aid
     * @param  int $id
     * @return \AvisoNavAPI\Http\Resources\Aid\CoordinateResource
     */
    public function show(Aid $aid, $id)
    {
        $coordinate = $aid->coordinates()->findOrFail($id);

        return new CoordinateResource($coordinate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Coordinate\StoreCoordinate  $request
     * @param  \AvisoNavAPI\Aid $aid
     * @param  int  $id
     * @return \AvisoNavAPI\Http\Resources\Aid\CoordinateResource
     */
    public function update(StoreCoordinate $request, Aid $aid, $id)
    {
        $coordinate = $aid->coordinates()->findOrFail($id);
        $coordinate->fill($request->only(['latitud', 'longitud', 'state']));

        if($coordinate->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }

        $coordinate->save();

        return new CoordinateResource($coordinate);
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
        $coordinate = $aid->coordinates()->findOrFail($id);

        $coordinate->delete();

        return new CoordinateResource($coordinate);
    }
}
