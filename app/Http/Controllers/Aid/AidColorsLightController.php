<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use AvisoNavAPI\Aid;
use AvisoNavAPI\ColorLight;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\ModelFilters\Basic\ColorLightFilter;
use AvisoNavAPI\Http\Requests\Aid\StoreAidColorLight;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\ColorLight\ColorLightResource;

class AidColorsLightController extends Controller
{

    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Aid $aid)
    {
        $collection = $aid->aidColorLight()->filter(request()->all(), ColorLightFilter::class)
                                   ->paginateFilter($this->perPage());

        return ColorLightResource::collection($collection);
    }
    

    public function store(StoreAidColorLight $request, Aid $aid)
    {
        $aid->aidColorLight()->attach(
                $request->input('colorLight'),
                ['angle' => $request->input('angle')]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAidColorLight $request, Aid $aid, ColorLight $colorLight)
    {
        // $aid->aidColorLight()->attach($colorLight->id);
        $aid->aidColorLight()->updateExistingPivot(
            $colorLight,
            [
                'color_light_id' => $request->input('colorLight'),
                'angle' => $request->input('angle')
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aid $aid, ColorLight $colorLight)
    {
        $aid->aidColorLight()->detach($colorLight->id);
    }
}
