<?php

namespace AvisoNavAPI\Http\Resources\Notice;

use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Collection;
use Illuminate\Pagination\AbstractPaginator;
use AvisoNavAPI\Http\Resources\EntityResource;
use AvisoNavAPI\Http\Resources\LocationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use AvisoNavAPI\Http\Resources\LightListResource;
use AvisoNavAPI\Http\Resources\ReportSourceResource;
use AvisoNavAPI\Http\Resources\ReportingUserResource;
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
            'year'                      => $this->year,
            'reportsNumbers'           => $this->reports_numbers,
            'reportDate'               => $this->report_date->format('Y-m-d'),
            'createdAt'                => $this->created_at->format('Y-m-d'),
            'updatedAt'                => $this->updated_at->format('Y-m-d'),
            'state'                     => $this->state,
            'file_info'                 => $this->file_info,
            'user'                      => $this->user,
            'parent'                    => null,
            'characterType'             => new CharacterTypeResource($this->characterType),
            'noveltyType'               => new NoveltyTypeResource($this->noveltyType),
            'location'                  => new LocationResource($this->location),
            'catalogOceanCoast'         => new CatalogOceanCoastResource($this->catalogOceanCoast),
            'lightList'                 => new LightListResource($this->lightList),
            'reportSource'             => new ReportSourceResource($this->reportSource),
            'reportingUser'            => new ReportingUserResource($this->reportingUser),
            'links'                     => [
                'self'          => route('notice.show', ['id' => $this->id]),
                'noticeLang'    => route('notice.noticeLang.index', ['id' => $this->id]),
                'noticeAid'     => route('notice.aid.index', ['id' => $this->id])
            ]
        ];
    }
}
