<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use AvisoNavAPI\Aid;
use AvisoNavAPI\AidLang;
use AvisoNavAPI\Coordenada;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\CoordenadaDetalle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use AvisoNavAPI\Http\Requests\Aid\StoreAid;
use AvisoNavAPI\ModelFilters\Basic\AidFilter;
use AvisoNavAPI\Http\Resources\Aid\AidResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Traits\Responser;

class AidController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Aid\AidResource
     */
    public function index()
    {
        $collection = Aid::filter(request()->all(), AidFilter::class)
                         ->with([
                             'coordinate',
                             'aidLang' => $this->withLanguageQuery(),
                             'location.zone.zoneLang' => $this->withLanguageQuery(),
                             'lightType.lightTypeLang' => $this->withLanguageQuery(),
                             'colorType.colorTypeLang' => $this->withLanguageQuery(),
                             'aidType.aidTypeLang' => $this->withLanguageQuery()
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
        $aid = new Aid($request->only(['number', 'subName', 'elevation', 'scope', 'quantity', 'observation']));
        $aid->aid_type_id = $request->input('aidType');
        $aid->location_id = $request->input('location');
        $aid->light_type_id = $request->input('lightType');
        $aid->color_type_id = $request->input('colorType');
        $aid->user = Auth::user()->username;
        $aid->save();

        $aidLang = new AidLang([$request->input('description')]);
        $aidLang->language_id = $request->input('language');

        $aid->aidLang()->save($aidLang);

        $aid->refresh();
        
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
        $aid->load([
            'coordinate',
            'aidLang' => $this->withLanguageQuery(),
            'location.zone.zoneLang' => $this->withLanguageQuery(),
            'lightType.lightTypeLang' => $this->withLanguageQuery(),
            'colorType.colorTypeLang' => $this->withLanguageQuery(),
            'aidType.aidTypeLang' => $this->withLanguageQuery()
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
        $aid->fill($request->only(['number', 'subName', 'elevation', 'scope', 'quantity', 'observation', 'state']));
        $aid->aid_type_id = $request->input('aidType');
        $aid->location_id = $request->input('location');
        $aid->light_type_id = $request->input('lightType');
        $aid->color_type_id = $request->input('colorType');
        $aid->user = Auth::user()->username;

        if($aid->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
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
