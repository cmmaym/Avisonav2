<?php

namespace AvisoNavAPI\Http\Resources\LightType;

use Illuminate\Http\Resources\Json\JsonResource;

class LightTypeLangResource extends JsonResource
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
            'class'             =>  $this->class,
            'description'       =>  $this->description,
            'created_at'        =>  $this->created_at->format('Y-m-d'),
            'updated_at'        =>  $this->updated_at->format('Y-m-d'),
            'links'              => [
                'self'  =>  route('lightType.lightTypeLang.show', ['lightTypeId' => $this->lightType->id, 'id' => $this->id]),
                'lightType' => route('lightType.show', ['id' => $this->lightType->id])
            ]
        ];
    }
}
