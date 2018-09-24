<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use AvisoNavAPI\Novelty;
use AvisoNavAPI\Coordinate;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Facades\Auth;
use AvisoNavAPI\Http\Resources\CoordinateResource;
use AvisoNavAPI\ModelFilters\Basic\CoordinateFilter;
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
        $coordinate = new Coordinate($request->only(['latitude', 'longitude']));

        $user = Auth::user();
        
        $novelty->coordinate()->save($coordinate, [
            'created_by' => $user->username,
            'updated_by' => $user->username,
        ]);

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
        $coordinate->fill($request->only(['latitude', 'longitude']));

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
