<?php

namespace AvisoNavAPI\Http\Resources\Notice;

use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Collection;
use Illuminate\Pagination\AbstractPaginator;
use AvisoNavAPI\Http\Resources\LocationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use AvisoNavAPI\Http\Resources\CoordinateResource;
use AvisoNavAPI\Http\Resources\SymbolPublicResource;
use AvisoNavAPI\Http\Resources\Notice\NoveltyResource;
use AvisoNavAPI\Http\Resources\Notice\NoveltySubResource;
use AvisoNavAPI\Http\Resources\Chart\ChartEditionResource;
use AvisoNavAPI\Http\Resources\NoveltyType\NoveltyTypeResource;
use AvisoNavAPI\Http\Resources\CharacterType\CharacterTypeResource;

class NoveltyPublicResource extends JsonResource
{
    use Responser;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $self = $this;
        $name = function() use ($self) {
            return $self->noveltyLang->name;
        };

        $description = function() use ($self) {
            return $self->notice->noticeLang->description;
        };

        $symbol = !is_null($this->symbol) ? (new SymbolPublicResource($this->symbol->symbol))->setIsLightPropertiesVisible($this->symbol->is_light_properties_visible) : null;

        return [
            'id'                        => $this->id,
            'notice'                    => $this->notice->number,
            'location'                  => new LocationResource($this->notice->location),
            'numItem'                   => $this->num_item,
            'name'                       =>  $this->when(!is_null($this->noveltyLang), $name, ''),
            'description'                =>  $this->when(!is_null($this->notice->noticeLang), $description, ''),
            'noveltyType'               => new NoveltyTypeResource($this->noveltyType),
            'characterType'             => new CharacterTypeResource($this->characterType),
            'createdAt'                => $this->created_at->format('Y-m-d'),
            'updatedAt'                => $this->updated_at->format('Y-m-d'),
            'chartEdition'              => ChartEditionResource::collection($this->chartEdition),
            'file'                      => NoveltyFileResource::collection($this->noveltyFile),
            'symbol'                    => $symbol,
            'parent'                    => new NoveltySubPublicResource($this->parent),
            'spatialData'               => $this->spatial_data,
        ];
    }
}
