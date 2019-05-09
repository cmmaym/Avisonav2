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

        $angle = function() use ($self){
            return $self->pivot->angle;
        };

        return [
            'id'                =>  $this->id,
            'color'             =>  $this->when(!is_null($this->colorLightLang), $color, null),
            'alias'             =>  $this->alias,
            $this->mergeWhen(!is_null($this->pivot), [
                'angle' => $this->when(!is_null($this->pivot), $angle, null),
            ]),
            $this->mergeWhen(!is_null($this->angle), [
                'angle' => $this->angle,
            ]),
            'createdAt'        =>  $this->created_at->format('Y-m-d'),
            'updatedAt'        =>  $this->updated_at->format('Y-m-d'),
            'createdBy'         => $this->created_by,
            'isLegacy'          => $this->is_legacy
        ];
    }
}
