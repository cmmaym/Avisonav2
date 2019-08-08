<?php

namespace AvisoNavAPI\Http\Resources\Aid;

use AvisoNavAPI\Http\Resources\LocationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AidMapResource extends JsonResource
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
            return $self->symbol->symbolLang->name;
        };
        
        return [
            'id'                => $this->id,
            'name'              => $this->when(!is_null($this->symbol->symbolLang), $name, null),
            'location'          => new LocationResource($this->symbol->location),
            'spatialData'       => $this->symbol->position
        ];
    }
}
