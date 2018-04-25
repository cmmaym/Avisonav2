<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AidResource extends JsonResource
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
            'id'                => $this->id,
            'number'            => $this->number,
            'sub_name'          => $this->sub_name,
            'created_at'        => $this->created_at->format('Y-m-d'),
            'updated_at'        => $this->updated_at->format('Y-m-d'),
            'state'             => $this->state,
            'location'          => new LocationResource($this->location),
            'lightType'        => new LightTypeLangResource($this->lightType->lightTypeLang),
            // 'links'             => [
            //     'self'  =>  route('aid.show', ['id' => $this->id])
            // ]
        ];
    }
}
