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

        $novelty->spatial_data = $geometry;
        $novelty->save();

        return $geometry;
    }

    public function getCurrentNoveltys()
    {
        $collection = Novelty::select('novelty.id', 'spatial_data')
                             ->join('notice', 'novelty.notice_id', 'notice.id')
                             ->join('character_type', 'novelty.character_type_id', 'character_type.id')
                             ->where('notice.state', '=', 'P')
                             ->where('novelty.state', '=', 'A')
                             ->where(function($query){
                                 $query->where('character_type.alias', '=', 'T')
                                       ->orWhere('character_type.alias', '=', 'G'); 
                             })
                             ->get();

        return $collection;
    }

    public function getNovelty($noveltyId)
    {
        $novelty = Novelty::with([
            'noveltyLang' => $this->withLanguageQuery(),
            'noveltyType.noveltyTypeLang' => $this->withLanguageQuery(),
            'characterType.characterTypeLang' => $this->withLanguageQuery(),
        ])
        ->findOrFail($noveltyId);

        $novelty->each(function($item){
            if($item->symbol)
            {
                $sn = $item->symbol;
                $item->load([
                    'symbol.symbol.symbolLang' => $this->withLanguageQuery(),
                    'symbol.symbol.aid.colorStructurePattern.colorStructureLang' => $this->withLanguageQuery(),
                    'symbol.symbol.aid.aidTypeForm.aidTypeFormLang' => $this->withLanguageQuery(),
                    'symbol.symbol.aid.topMark.topMarkLang' => $this->withLanguageQuery(),
                    'symbol.symbol.aid.height' => function($query) use ($sn){
                        $query->where('id', $sn->height_id);
                    },
                    'symbol.symbol.aid.nominalScope' => function($query) use ($sn){
                        $query->where('id', $sn->nominal_scope_id);
                    },
                    'symbol.symbol.aid.period' => function($query) use ($sn){
                        $query->where('id', $sn->period_id);
                    }
                ]);
            }
        });

        return new NoveltyPublicResource($novelty);
    }
}