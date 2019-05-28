<?php

namespace AvisoNavAPI\Http\Controllers\Notice;

use AvisoNavAPI\Novelty;
use Illuminate\Http\Request;
use AvisoNavAPI\CharacterType;
use AvisoNavAPI\Traits\Filter;
use AvisoNavAPI\Traits\Responser;
use Grimzy\LaravelMysqlSpatial\Types\Geometry;
use AvisoNavAPI\ModelFilters\Basic\NoveltyFilter;
use AvisoNavAPI\Http\Resources\Notice\NoveltyResource;
use AvisoNavAPI\Http\Controllers\ApiController as Controller;
use AvisoNavAPI\Http\Resources\Notice\NoveltyPublicResource;
use AvisoNavAPI\Chart;
use Illuminate\Support\Carbon;

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
                                       ->where('state', 'A')
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

    public function getCurrentNoveltys()
    {
        $collection['novelty'] = Novelty::select('novelty.id', 'spatial_data')
                             ->join('notice', 'novelty.notice_id', 'notice.id')
                             ->join('character_type', 'novelty.character_type_id', 'character_type.id')
                             ->where('notice.state', '=', 'P')
                             ->where(function($query){
                                 $query->where('character_type.alias', '=', 'T')
                                       ->orWhere(function($query){
                                           $query->where(function($query){
                                                    $query->where('character_type.alias', '=', 'G')
                                                            ->orWhere('character_type.alias', '=', 'P');
                                                        });
                                       }); 
                             })
                             ->where('notice.created_at', '>=', Carbon::now()->subDays(30)->toDateString())
                             ->get();

        $collection['chart'] = Chart::select('number', 'area')->get();

        return $collection;
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
            
            if($novelty->symbol){

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