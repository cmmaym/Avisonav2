<?php

namespace AvisoNavAPI\Http\Resources\Danger;

use AvisoNavAPI\Http\Resources\LocationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use AvisoNavAPI\Http\Resources\ImageResource;

class DangerResource extends JsonResource
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
            return $self->symbolLang->name;
        };
        
        $observation = function() use ($self){
            return $self->symbolLang->observation;
        };

        return [
            'id'                => $this->id,
            'name'              => $this->when(!is_null($this->symbolLang), $name, null),
            'createdAt'        => $this->created_at->format('Y-m-d'),
            'updatedAt'        => $this->updated_at->format('Y-m-d'),
            'observation'       => $this->when(!is_null($this->symbolLang), $observation, null),
            'createdBy'         => $this->created_by,
            'location'          => new LocationResource($this->location),
            'image'             => new ImageResource($this->image),
        ];
    }
}