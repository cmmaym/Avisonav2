<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Aid;
use AvisoNavAPI\ModelFilters\Basic\CoordinateFilter;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Resources\CoordinateResource;
use AvisoNavAPI\Http\Requests\Coordinate\StoreCoordinate;
use AvisoNavAPI\Coordinate;
use AvisoNavAPI\Traits\Responser;

class AidCoordinateController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Aid\CoordinateResource
     */
    public function index(Aid $aid)
    {
        $collection = $aid->symbol->coordinate()->filter(request()->all(), CoordinateFilter::class)
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
        $coordinate = new Coordinate();
        $coordinate->latitude_degrees = $request->input('latitudeDegrees');
        $coordinate->latitude_minutes = $request->input('latitudeMinutes');
        $coordinate->latitude_seconds = $request->input('latitudeSeconds');
        $coordinate->latitude_dir     = $request->input('latitudeDir');
        $coordinate->longitude_degrees = $request->input('longitudeDegrees');
        $coordinate->longitude_minutes = $request->input('longitudeMinutes');
        $coordinate->longitude_seconds = $request->input('longitudeSeconds');
        $coordinate->longitude_dir     = $request->input('longitudeDir');

        $aid->symbol->coordinate()->save($coordinate);

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
        $coordinate = $aid->symbol->coordinate()->findOrFail($id);
        $coordinate->latitude_degrees = $request->input('latitudeDegrees');
        $coordinate->latitude_minutes = $request->input('latitudeMinutes');
        $coordinate->latitude_seconds = $request->input('latitudeSeconds');
        $coordinate->latitude_dir     = $request->input('latitudeDir');
        $coordinate->longitude_degrees = $request->input('longitudeDegrees');
        $coordinate->longitude_minutes = $request->input('longitudeMinutes');
        $coordinate->longitude_seconds = $request->input('longitudeSeconds');
        $coordinate->longitude_dir     = $request->input('longitudeDir');

        if($coordinate->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
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
        $coordinate = $aid->symbol->coordinate()->findOrFail($id);

        $aid->symbol->coordinate()->detach($coordinate->id);
    }
}
