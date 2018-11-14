<?php

namespace AvisoNavAPI\Http\Controllers\Danger;

use AvisoNavAPI\Symbol;
use AvisoNavAPI\Language;
use AvisoNavAPI\SymbolLang;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Facades\DB;
use Grimzy\LaravelMysqlSpatial\Types\Geometry;
use AvisoNavAPI\ModelFilters\Basic\DangerFilter;
use AvisoNavAPI\Http\Requests\Danger\StoreDanger;
use AvisoNavAPI\Http\Resources\Danger\DangerResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\SymbolType;

class DangerController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Danger\DangerResource
     */
    public function index()
    {
        $collection = Symbol::filter(request()->all(), DangerFilter::class)
                         ->with([
                             'symbolLang' => $this->withLanguageQuery(),
                             'location.zone.zoneLang' => $this->withLanguageQuery(),
                         ])
                         ->whereHas('symbolType', function($query){
                            $query->where('code', '=', 'D1');
                         })
                         ->paginateFilter($this->perPage());

        return DangerResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AvisoNavAPI\Http\Requests\Danger\StoreDanger  $request
     * @return \AvisoNavAPI\Http\Resources\Danger\DangerResource
     */
    public function store(StoreDanger $request)
    {
        $symbol = DB::transaction(function () use ($request){

            $language = Language::where('code','es')->firstOrFail();
            $symbolType = SymbolType::where('code', 'D1')->firstOrFail();

            $symbol = new Symbol();
            $symbol->symbol_type_id = $symbolType->id;
            $symbol->image_id = $request->input('image');
            $symbol->location_id = $request->input('location');
            $symbol->save();

            $symbolLang = new SymbolLang($request->only(['name']));
            $symbolLang->observation = ($request->input('observation')) ? $request->input('observation') : null;
            $symbolLang->language_id = $language->id;

            $symbol->symbolLang()->save($symbolLang);

            return $symbol;
        });
        
        return new DangerResource($symbol);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $symbolId
     * @return \AvisoNavAPI\Http\Resources\Danger\DangerResource
     */
    public function show($symbolId)
    {
        $symbol = Symbol::findOrFail($symbolId);
        
        $symbol->load([
            'symbolLang' => $this->withLanguageQuery(),
            'location.zone.zoneLang' => $this->withLanguageQuery()
        ]);

        return new DangerResource($symbol);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $symbolId
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDanger $request, $symbolId)
    {
        $symbol = Symbol::findOrFail($symbolId);

        $symbol->location_id = $request->input('location');
        $symbol->image_id = $request->input('image');

        $symbol->save();

        return new DangerResource($symbol);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $symbolId
     * @return \Illuminate\Http\Response
     */
    public function destroy($symbolId)
    {
        $symbol = Symbol::findOrFail($symbolId);

        $symbol->delete();

        return new DangerResource($symbol);
    }

    public function getPosition($symbol)
    {
        $symbol = Symbol::findOrFail($symbol);
        $position = $symbol->position;

        return $position;
    }
    
    public function updatePosition(Request $request, $symbol)
    {
        $symbol = Symbol::findOrFail($symbol);
        
        $data = $request->getContent();
        $geometry = Geometry::fromJson($data);

        $symbol->position = ($geometry->getGeometries()) ? $geometry->getGeometries()[0] : null;

        $symbol->save();

        return $symbol->position;
    }
}
