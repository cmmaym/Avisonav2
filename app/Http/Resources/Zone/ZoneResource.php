<?php

namespace AvisoNavAPI\Http\Resources\Zone;

use Illuminate\Http\Resources\Json\JsonResource;

class ZoneResource extends JsonResource
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
        $name = function() use ($self){
            return $self->zoneLang->name;
        };
        
        $alias = function() use ($self){
            return $self->zoneLang->alias;
        };

        return [
            'id'                =>  $this->id,
            'name'              =>  $this->when(!is_null($this->zoneLang), $name, null),
            'alias'             =>  $this->when(!is_null($this->zoneLang), $alias, null),
            'createdAt'        =>  $this->created_at->format('Y-m-d'),
            'updatedAt'        =>  $this->updated_at->format('Y-m-d'),
            'links'              => [
                'self'      =>  route('zone.show', ['id' => $this->id]),
                'zoneLang'  =>  route('zone.zoneLang.index', ['id' => $this->id])
            ]
        ];
    }
}
