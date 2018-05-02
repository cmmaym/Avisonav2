<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use AvisoNavAPI\Aid;
use AvisoNavAPI\Coordenada;
use Illuminate\Http\Request;
use AvisoNavAPI\CoordenadaDetalle;
use Illuminate\Support\Facades\DB;
use AvisoNavAPI\Http\Controllers\Controller;
use AvisoNavAPI\Http\Resources\Aid\AidResource;
use AvisoNavAPI\Http\Requests\Aid\StoreAid;
use AvisoNavAPI\ModelFilters\Basic\AidFilter;
use AvisoNavAPI\Traits\Filter;

class AidController extends Controller
{
    use Filter;

    public function __construct()
    {
        if(!request()->exists('language')) request()->merge(['language' => '1']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Aid\AidResource
     */
    public function index()
    {
        $language = request()->input('language');
        $collection = Aid::filter(request()->all(), AidFilter::class)
                         ->with([
                             'coordinate',
                             'aidLang' => function($query) use ($language){
                                $query->where('language_id', $language);
                              },
                             'location.zone.zoneLang' => function($query) use ($language){
                                $query->where('language_id', $language);
                              },
                             'lightType.lightTypeLang' => function($query) use ($language){
                                $query->where('language_id', $language);
                              },
                             'colorType.colorTypeLang' => function($query) use ($language){
                                $query->where('language_id', $language);
                              },
                             'aidType.aidTypeLang' => function($query) use ($language){
                                $query->where('language_id', $language);
                              }
                         ])
                         ->paginateFilter($this->perPage());

        return AidResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Aid\StoreAid  $request
     * @return \AvisoNavAPI\Http\Resources\Aid\AidResource
     */
    public function store(StoreAid $request)
    {
        $aid = new Aid($request->only(['number', 'sub_name', 'elevation', 'scope', 'quantity', 'observation']));
        $aid->aid_type_id = $request->input('aid_type_id');
        $aid->location_id = $request->input('location_id');
        $aid->light_type_id = $request->input('light_type_id');
        $aid->color_type_id = $request->input('color_type_id');
        $aid->user = 'JMARDZ';
        $aid->save();
        
        return new AidResource($aid);
    }

    /**
     * Display the specified resource.
     *
     * @param  \AvisoNavAPI\Aid  $aid
     * @return \AvisoNavAPI\Http\Resources\Aid\AidResource
     */
    public function show(Aid $aid)
    {
        $language = request()->input('language');
        $aid->load([
            'coordinate',
            'aidLang' => function($query) use ($language){
            $query->where('language_id', $language);
            },
            'location.zone.zoneLang' => function($query) use ($language){
            $query->where('language_id', $language);
            },
            'lightType.lightTypeLang' => function($query) use ($language){
            $query->where('language_id', $language);
            },
            'colorType.colorTypeLang' => function($query) use ($language){
            $query->where('language_id', $language);
            },
            'aidType.aidTypeLang' => function($query) use ($language){
            $query->where('language_id', $language);
            }
        ]);

        return new AidResource($aid);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \AvisoNavAPI\Aid  $aayuda
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAid $request, Aid $aid)
    {
        $aid->fill($request->only(['number', 'sub_name', 'elevation', 'scope', 'quantity', 'observation', 'state']));

        if($aid->isClean()){
            return response()->json(['error' => ['title' => 'Debe espesificar por lo menos un valor diferente para actualizar', 'status' => 422]], 422);
        }

        $aid->save();

        return new AidResource($aid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AvisoNavAPI\Aid  $ayuda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aid $aid)
    {
        $aid->delete();

        return new AidResource($aid);
    }
}
