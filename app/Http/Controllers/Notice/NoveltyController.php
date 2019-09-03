<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use AvisoNavAPI\Chart;
use AvisoNavAPI\Notice;
use AvisoNavAPI\Novelty;
use Illuminate\Http\Request;
use AvisoNavAPI\CharacterType;
use AvisoNavAPI\Traits\Filter;
use Illuminate\Support\Carbon;
use AvisoNavAPI\Traits\Responser;
use Grimzy\LaravelMysqlSpatial\Types\Geometry;
use AvisoNavAPI\ModelFilters\Basic\NoveltyFilter;
use AvisoNavAPI\Http\Resources\Notice\NoveltyResource;
use AvisoNavAPI\ModelFilters\NoticeNoveltyFilter;
use AvisoNavAPI\Http\Resources\Notice\NoveltyPublicResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\Notice\NoticePublicResource;

class NoveltyController extends Controller
{
    use Filter, Responser;

    /**
     * Display a listing of the resource.
     *
     * @return \AvisoNavAPI\Http\Resources\Notice\NoveltyResource
     */
    public function index()
    {
       $collection = Novelty::filter(request()->all(), NoveltyFilter::class)
                                       ->with([
                                            'characterType.characterTypeLang' => $this->withLanguageQuery(),
                                            'noveltyType.noveltyTypeLang' => $this->withLanguageQuery(),
                                       ])
                                       ->where('novelty.state', 'A')
                                       ->whereHas('characterType', function($query){
                                            $query->where('alias', '<>', 'P');
                                       })
                                       ->paginateFilter($this->perPage());

        return NoveltyResource::collection($collection);
    }

    public function getAllNovelty()
    {
        $collection = Novelty::filter(request()->all(), NoveltyFilter::class)
                                       ->with([
                                            'characterType.characterTypeLang' => $this->withLanguageQuery(),
                                            'noveltyType.noveltyTypeLang' => $this->withLanguageQuery(),
                                       ])
                                       ->where('novelty.state', 'A')
                                       ->paginateFilter($this->perPage());

        return NoveltyResource::collection($collection);
    }

    public function getSpatialData($noveltyId)
    {
        $novelty = Novelty::findOrFail($noveltyId);
        $spatialData = $novelty->spatial_data;

        return $spatialData;
    }
    
    public function updateSpatialData(Request $request, $noveltyId)
    {
        $novelty = Novelty::findOrFail($noveltyId);
        
        $data = $request->getContent();
        $geometry = Geometry::fromJson($data);

        $novelty->spatial_data = ($geometry->getGeometries()) ? $geometry : null;
        $novelty->save();

        return $geometry;
    }

    public function getCurrentNoveltys(){
        
        $collection = Notice::filter(request()->all(), NoticeNoveltyFilter::class)
                            ->with([
                                'novelty',
                                'novelty.noveltyLang'
                            ])
                            ->get();

        return NoticePublicResource::collection($collection);
    }

    public function getNovelty($noveltyId)
    {
        $novelty = Novelty::with([
            'noveltyLang' => $this->withLanguageQuery(),
            'noveltyType.noveltyTypeLang' => $this->withLanguageQuery(),
            'characterType.characterTypeLang' => $this->withLanguageQuery(),
            'notice.noticeLang' => $this->withLanguageQuery(),
            'symbol.symbol.symbolLang' => $this->withLanguageQuery(),
            'symbol.symbol.aid.colorStructurePattern.colorStructureLang' => $this->withLanguageQuery(),
            'symbol.symbol.aid.aidTypeForm.aidTypeFormLang' => $this->withLanguageQuery(),
            'symbol.symbol.aid.topMark.topMarkLang' => $this->withLanguageQuery(),
            ])
            ->findOrFail($noveltyId);
            
            if($novelty->symbol && $novelty->symbol->symbol->aid){

                $height_id = $novelty->symbol->height_id;
                $nominalScope_id = $novelty->symbol->nominal_scope_id;
                $period_id = $novelty->symbol->period_id;
                
                $novelty->symbol->symbol->aid->load([
                    'height' => function($query) use ($height_id){
                        $query->where('id', $height_id);
                    },
                    'nominalScope' => function($query) use ($nominalScope_id){
                        $query->where('id', $nominalScope_id);
                    },
                    'period' => function($query) use ($period_id){
                        $query->where('id', $period_id);
                    },
                ]);
            }

        return new NoveltyPublicResource($novelty);
    }
}