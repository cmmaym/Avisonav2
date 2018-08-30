<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use AvisoNavAPI\Novelty;
use AvisoNavAPI\Coordinate;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\ModelFilters\Basic\CoordinateFilter;
use AvisoNavAPI\Http\Resources\CoordinateResource;
use AvisoNavAPI\Http\Requests\Coordinate\StoreCoordinate;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

class NoveltyCoordinateController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\CoordinateResource
     */
    public function index(Novelty $novelty)
    {
        $collection = $novelty->coordinate()->filter(request()->all(), CoordinateFilter::class)
                                         ->paginateFilter($this->perPage());

        return CoordinateResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Coordinate\StoreCoordinate  $request
     * @return \AvisoNavAPI\Http\Resources\CoordinateResource
     */
    public function store(StoreCoordinate $request, Novelty $novelty)
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

        $novelty->coordinate()->save($coordinate);

        return new CoordinateResource($coordinate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Coordinate\StoreCoordinate  $request
     * @param  \AvisoNavAPI\Novelty $novelty
     * @param  int  $id
     * @return \AvisoNavAPI\Http\Resources\CoordinateResource
     */
    public function update(StoreCoordinate $request, Novelty $novelty, $id)
    {
        $coordinate = $novelty->coordinate()->findOrFail($id);
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
     * @param  \AvisoNavAPI\Novelty $novelty
     * @param  int  $id
     * @return \AvisoNavAPI\Http\Resources\Aid\CoordinateResource
     */
    public function destroy(Novelty $novelty, $id)
    {
        $coordinate = $novelty->coordinate()->findOrFail($id);

        $novelty->coordinate()->detach($coordinate->id);
    }
}
