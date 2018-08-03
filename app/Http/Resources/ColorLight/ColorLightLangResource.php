<?php

namespace AvisoNavAPI\Http\Resources\ColorLight;

use Illuminate\Http\Resources\Json\JsonResource;

class ColorLightLangResource extends JsonResource
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
            'color'             =>  $this->color,
            'createdAt'        =>  $this->created_at->format('Y-m-d'),
            'updatedAt'        =>  $this->updated_at->format('Y-m-d'),
            'links'             => [
                'self'  =>  route('colorLight.colorLightLang.show', ['colorLightId' => $this->colorLight->id, 'id' => $this->id]),
                'colorLight' => route('colorLight.show', ['id' => $this->colorLight->id])
            ]
        ];
    }
}
