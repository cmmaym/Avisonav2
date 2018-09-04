<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use AvisoNavAPI\Aid;
use AvisoNavAPI\SymbolLang;
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
use AvisoNavAPI\Symbol;

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
                             'symbol.symbolLang' => $this->withLanguageQuery(),
                             'symbol.location.zone.zoneLang' => $this->withLanguageQuery(),
                             'lightClass.lightClassLang' => $this->withLanguageQuery(),
                             'colorStructurePattern.colorStructureLang' => $this->withLanguageQuery(),
                             'topMark.topMarkLang' => $this->withLanguageQuery(),
                             'aidType.aidTypeLang' => $this->withLanguageQuery(),
                             'aidTypeForm.aidTypeFormLang' => $this->withLanguageQuery()
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
        $symbolAid = DB::transaction(function () use ($request){
            $symbol = new Symbol();
            $symbol->symbol_type_id = 1;
            $symbol->image_id = $request->input('image');
            $symbol->location_id = $request->input('location');
            $symbol->save();

            $symbolLang = new SymbolLang($request->only(['name']));
            $symbolLang->observation = ($request->input('observation')) ? $request->input('observation') : null;
            $symbolLang->language_id = $request->input('language');

            $symbol->symbolLang()->save($symbolLang);

            $aid = new Aid($request->only(['height', 'scope', 'features']));
            $aid->elevation_nmm = $request->input('elevationNmm');
            $aid->flash_groups = $request->input('flashGroups');
            $aid->period = $request->input('period');
            $aid->user = Auth::user()->username;
            $aid->light_class_id = $request->input('lightClass');
            $aid->color_structure_pattern_id = $request->input('colorStructurePattern');
            $aid->aid_type_id = $request->input('aidType');
            $aid->aid_type_form_id = $request->input('aidTypeForm');

            $aid->racon = ($request->input('racon')) ? $request->input('racon') : null;
            $aid->ais = ($request->input('ais')) ? $request->input('ais') : null;
            $aid->top_mark_id = ($request->input('topMark')) ? $request->input('topMark') : null;

            $symbol->aid()->save($aid);

            return $aid;
        });
        
        return new AidResource($symbolAid);
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
            'symbol.symbolLang' => $this->withLanguageQuery(),
            'symbol.location.zone.zoneLang' => $this->withLanguageQuery(),
            'lightClass.lightClassLang' => $this->withLanguageQuery(),
            'colorStructurePattern.colorStructureLang' => $this->withLanguageQuery(),
            'topMark.topMarkLang' => $this->withLanguageQuery(),
            'aidType.aidTypeLang' => $this->withLanguageQuery(),
            'aidTypeForm.aidTypeFormLang' => $this->withLanguageQuery()
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
        $aid->fill($request->only(['ais', 'height', 'scope', 'features']));
        $aid->elevation_nmm = $request->input('elevationNmm');
        $aid->flash_groups = $request->input('flashGroups');
        $aid->period = $request->input('period');
        $aid->user = Auth::user()->username;
        $aid->location_id = $request->input('location');
        $aid->light_class_id = $request->input('lightClass');
        $aid->color_structure_pattern_id = $request->input('colorStructurePattern');
        $aid->top_mark_id = $request->input('topMark');
        $aid->aid_type_id = $request->input('aidType');
        $aid->aid_type_form_id = $request->input('aidTypeForm');

        $aid->racon = ($request->input('racon')) ? $request->input('racon') : null;
        $aid->ais = ($request->input('ais')) ? $request->input('ais') : null;
        $aid->top_mark_id = ($request->input('topMark')) ? $request->input('topMark') : null;

        $aid->symbol->location_id = $request->input('location');

        if($aid->isClean()){
            return $this->errorResponse('Debe espesificar por lo menos un valor diferente para actualizar', 409);
        }

        $aid->symbol->save();
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
        $aid->symbol->delete();

        return new AidResource($aid);
    }
}
