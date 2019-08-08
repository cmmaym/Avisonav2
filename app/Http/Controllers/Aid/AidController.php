<?php

namespace AvisoNavAPI\Http\Controllers\Aid;

use AvisoNavAPI\Aid;
use AvisoNavAPI\Symbol;
use AvisoNavAPI\Language;
use AvisoNavAPI\Coordenada;
use AvisoNavAPI\SymbolLang;
use AvisoNavAPI\SymbolType;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use AvisoNavAPI\CoordenadaDetalle;
use AvisoNavAPI\Exports\AidExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use AvisoNavAPI\Http\Requests\Aid\StoreAid;
use AvisoNavAPI\ModelFilters\Basic\AidFilter;
use Grimzy\LaravelMysqlSpatial\Types\Geometry;
use AvisoNavAPI\Http\Resources\Aid\AidResource;
use AvisoNavAPI\Http\Resources\Aid\AidMapResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;

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

            $language = Language::where('code','es')->firstOrFail();
            $symbolType = SymbolType::where('code', 'A1')->firstOrFail();

            $symbol = new Symbol();
            $symbol->symbol_type_id = $symbolType->id;
            $symbol->image_id = $request->input('image');
            $symbol->location_id = $request->input('location');
            $symbol->save();

            $symbolLang = new SymbolLang($request->only(['name']));
            $symbolLang->observation = ($request->input('observation')) ? $request->input('observation') : null;
            $symbolLang->language_id = $language->id;

            $symbol->symbolLang()->save($symbolLang);

            $aid = new Aid();
            $aid->racon = ($request->input('racon')) ? $request->input('racon') : false;
            $aid->radar_reflector = ($request->input('radarRelector')) ? $request->input('reflectorRadar') : false;
            $aid->light_class_id = $request->input('lightClass');
            $aid->color_structure_pattern_id = $request->input('colorStructurePattern');
            $aid->aid_type_id = $request->input('aidType');
            $aid->aid_type_form_id = $request->input('aidTypeForm');

            $aid->ais = ($request->input('ais')) ? $request->input('ais') : null;
            $aid->float_diameter = ($request->input('floatDiameter')) ? $request->input('floatDiameter') : null;
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
        $aid->racon = ($request->input('racon')) ? $request->input('racon') : false;
        $aid->radar_reflector = ($request->input('radarReflector')) ? $request->input('radarReflector') : false;
        $aid->light_class_id = $request->input('lightClass');
        $aid->color_structure_pattern_id = $request->input('colorStructurePattern');
        $aid->top_mark_id = $request->input('topMark');
        $aid->aid_type_id = $request->input('aidType');
        $aid->aid_type_form_id = $request->input('aidTypeForm');

        $aid->ais = ($request->input('ais')) ? $request->input('ais') : null;
        $aid->float_diameter = ($request->input('floatDiameter')) ? $request->input('floatDiameter') : null;
        $aid->top_mark_id = ($request->input('topMark')) ? $request->input('topMark') : null;

        $aid->symbol->location_id = $request->input('location');
        $aid->symbol->image_id = $request->input('image');

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

    public function getPosition($aid)
    {
        $aid = Aid::findOrFail($aid);
        $position = $aid->symbol->position;

        return $position;
    }
    
    public function updatePosition(Request $request, $aid)
    {
        $aid = Aid::findOrFail($aid);
        $symbol = $aid->symbol;
        
        $data = $request->getContent();
        $geometry = Geometry::fromJson($data);

        $symbol->position = ($geometry->getGeometries()) ? $geometry->getGeometries()[0] : null;

        $symbol->save();

        return $symbol->position;
    }

    public function export()
    {
        return Excel::download(new AidExport, 'aid.xlsx');
    }

    public function getAllAid(){
        $collection = Aid::with([
                             'symbol.symbolLang' => $this->withLanguageQuery(),
                             'symbol.location.zone.zoneLang' => $this->withLanguageQuery()
                         ])
                         ->whereHas("symbol", function($query){
                            $query->where("is_legacy", true);
                         })
                         ->get();

        return AidMapResource::collection($collection);
    }
}
