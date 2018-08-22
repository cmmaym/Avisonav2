<?php

namespace AvisoNavAPI\Http\Resources\Zone;

use AvisoNavAPI\Http\Resources\LanguageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ZoneLangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                =>  $this->id,
            'name'              =>  $this->name,
            'alias'             =>  $this->alias,
            'createdAt'        =>  $this->created_at->format('Y-m-d'),
            'updatedAt'        =>  $this->updated_at->format('Y-m-d'),
            'language'          => new LanguageResource($this->language),
            'links'              => [
                'self'  =>  route('zone.zoneLang.update', ['zoneId' => $this->zone->id, 'zoneLangId' => $this->id]),
                'zona'  =>  route('zone.show', ['id' => $this->zone->id])
            ]
        ];
    }
}
