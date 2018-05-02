<?php

namespace AvisoNavAPI\Http\Resources\ColorType;

use Illuminate\Http\Resources\Json\JsonResource;

class ColorTypeResource extends JsonResource
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
            return $self->colorTypeLang->color;
        };
        
        $alias = function() use ($self){
            return $self->colorTypeLang->alias;
        };

        return [
            'id'                =>  $this->id,
            'color'             =>  $this->when(!is_null($this->colorTypeLang), $color, null),
            'alias'             =>  $this->when(!is_null($this->colorTypeLang), $alias, null),
            'created_at'        =>  $this->created_at->format('Y-m-d'),
            'updated_at'        =>  $this->updated_at->format('Y-m-d'),
            'state'             =>  $this->state,
            'links'             => [
                'self'  =>  route('colorType.show', ['id' => $this->id]),
                'colorTypeLang' => route('colorType.colorTypeLang.index', ['id' => $this->id])
            ]
        ];
    }
}
