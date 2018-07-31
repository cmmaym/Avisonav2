<?php

namespace AvisoNavAPI\Http\Resources\Notice;

use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Collection;
use Illuminate\Pagination\AbstractPaginator;
use AvisoNavAPI\Http\Resources\EntityResource;
use Illuminate\Http\Resources\Json\JsonResource;
use AvisoNavAPI\Http\Resources\LightListResource;
use AvisoNavAPI\Http\Resources\Zone\ZoneResource;
use AvisoNavAPI\Http\Resources\CatalogOceanCoastResource;
use AvisoNavAPI\Http\Resources\NoveltyType\NoveltyTypeResource;
use AvisoNavAPI\Http\Resources\CharacterType\CharacterTypeResource;

class NoticeResource extends JsonResource
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
        $noticeLang = function() use ($self) {
            return $self->noticeLang->observation;
        };

        return [
            'id'                        => $this->id,
            'number'                    => $this->number,
            'date'                      => $this->date,
            'year'                      => $this->year,
            'created_at'                => $this->created_at->format('Y-m-d'),
            'updated_at'                => $this->updated_at->format('Y-m-d'),
            'state'                     => $this->state,
            'file_info'                 => $this->file_info,
            'user'                      => $this->user,
            'observation'               => $this->when(!is_null($this->noticeLang), $noticeLang, null),
            'characterType'             => new CharacterTypeResource($this->characterType),
            'noveltyType'               => new NoveltyTypeResource($this->noveltyType),
            'entity'                    => new EntityResource($this->entity),
            'zone'                      => new ZoneResource($this->zone),
            'catalogOceanCoast'         => new CatalogOceanCoastResource($this->catalogOceanCoast),
            'lightList'                 => new LightListResource($this->lightList),
            'links'                     => [
                'self'          => route('notice.show', ['id' => $this->id]),
                'noticeLang'    => route('notice.noticeLang.index', ['id' => $this->id]),
                'noticeAid'     => route('notice.aid.index', ['id' => $this->id])
            ]
        ];
    }
}
