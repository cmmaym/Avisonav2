<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use AvisoNavAPI\Aid;
use AvisoNavAPI\AidDetail;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Requests\Aid\StoreAidDetail;
use AvisoNavAPI\Http\Resources\AidDetailResource;
use AvisoNavAPI\ModelFilters\Basic\AidDetailFilter;

class AidDetailController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Aid $aid)
    {
        $collection = $aid->aidDetail()->filter(request()->all(), AidDetailFilter::class)->paginateFilter($this->perPage());

        return AidDetailResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAidDetail $request, Aid $aid)
    {
        $aidDetail = new AidDetail($request->only(['description', 'observation', 'state']));
        $aidDetail->coordinate_id = $request->input('coordinate_id');
        $aidDetail->light_type_id = $request->input('light_type_id');
        $aidDetail->color_type_id = $request->input('color_type_id');
        $aidDetail->novelty_type_id = $request->input('novelty_type_id');
        $aidDetail->language_id = $request->input('language_id');
        
        $aid->aidDetail()->save($aidDetail);

        $parentDetail = AidDetail::where('aid_id', $aid->id)
                                ->whereHas('language', function ($query){
                                    $query->where('code', 'es');
                                })
                                ->first();

        if(!is_null($parentDetail))
        {
            $parentDetail->aidDetail()->save($aidDetail);
        }

        return new AidDetailResource($aidDetail);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAidDetail $request, Aid $aid, AidDetail $aidDetail)
    {
        $aidDetail->fill($request->only(['description', 'observation', 'state']));
        $aidDetail->coordinate_id = $request->input('coordinate_id');
        $aidDetail->light_type_id = $request->input('light_type_id');
        $aidDetail->color_type_id = $request->input('color_type_id');
        $aidDetail->novelty_type_id = $request->input('novelty_type_id');
        $aidDetail->language_id = $request->input('language_id');

        if($aidDetail->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }

        $aidDetail->save();

        return new AidDetailResource($aidDetail);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aid $aid, AidDetail $aidDetail)
    {
        $aidDetail->delete();

        return new AidDetailResource($aidDetail);
    }
}
