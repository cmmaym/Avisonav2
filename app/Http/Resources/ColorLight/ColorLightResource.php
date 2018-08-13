<?php

namespace AvisoNavAPI\Http\Resources\ColorLight;

use Illuminate\Http\Resources\Json\JsonResource;

class ColorLightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $self= $this;
        $color = function() use ($self){
            return $self->colorLightLang->color;
        };

        return [
            'id'                =>  $this->id,
            'color'             =>  $this->when(!is_null($this->colorLightLang), $color, null),
            'alias'             =>  $this->alias,
            $this->mergeWhen(!is_null($this->angle), [
                'angle' => $this->angle,
            ]),
            'createdAt'        =>  $this->created_at->format('Y-m-d'),
            'updatedAt'        =>  $this->updated_at->format('Y-m-d'),
            'links'             => [
                'self'  =>  route('colorLight.show', ['id' => $this->id]),
                'colorLightLang' => route('colorLight.colorLightLang.index', ['id' => $this->id])
            ]
        ];
    }
}
