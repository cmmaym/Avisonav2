<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ColorTypeLangResource extends JsonResource
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
            'alias'             =>  $this->alias,
            'created_at'        =>  $this->created_at->format('Y-m-d'),
            'updated_at'        =>  $this->updated_at->format('Y-m-d'),
            'links'             => [
                'self'  =>  route('colorType.colorTypeLang.show', ['colorTypeId' => $this->colorType->id, 'id' => $this->id]),
                'colorType' => route('colorType.show', ['id' => $this->colorType->id])
            ]
        ];
    }
}
