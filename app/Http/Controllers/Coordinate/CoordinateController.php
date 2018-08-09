<?php

namespace AvisoNavAPI\Http\Controllers\Coordinate;

use AvisoNavAPI\Coordinate;
use Illuminate\Http\Request;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\CoordinateResource;
use AvisoNavAPI\Http\Requests\Coordinate\StoreCoordinate;

class CoordinateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoordinate $request)
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
        $coordinate->save();

        return new CoordinateResource($coordinate);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Coordinate $coordinate)
    {
        return new CoordinateResource($coordinate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCoordinate $request, Coordinate $coordinate)
    {
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coordinate $coordinate)
    {
        $coordinate->delete();

        return new CoordinateResource($coordinate);
    }
}
