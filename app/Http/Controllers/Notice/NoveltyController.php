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
}