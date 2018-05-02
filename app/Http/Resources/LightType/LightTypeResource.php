<?php

namespace AvisoNavAPI\Http\Resources\LightType;

use Illuminate\Http\Resources\Json\JsonResource;

class LightTypeResource extends JsonResource
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
        $class = function() use ($self){
            return $self->lightTypeLang->class;
        };
        
        $description = function() use ($self){
            return $self->lightTypeLang->description;
        };

        return [
            'id'                =>  $this->id,
            'alias'             =>  $this->alias,
            'class'             =>  $this->when(!is_null($this->lightTypeLang), $class, null),
            'description'       =>  $this->when(!is_null($this->lightTypeLang), $description, null),
            'illustration'      =>  $this->illustration,
            'created_at'        =>  $this->created_at->format('Y-m-d'),
            'updated_at'        =>  $this->updated_at->format('Y-m-d'),
            'state'             =>  $this->state,
            'links'              => [
                'self'  =>  route('lightType.show', ['id' => $this->id]),
                'lightTypeLang' => route('lightType.lightTypeLang.index', ['id' => $this->id])
            ]
        ];
    }
}
