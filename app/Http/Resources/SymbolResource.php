<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use AvisoNavAPI\Http\Resources\Aid\CoordinateResource;
use AvisoNavAPI\Http\Resources\ImageResource;

class SymbolResource extends JsonResource
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
            'observation'       => $this->when(!is_null($this->symbolLang), $observation, null),
            'createdAt'         => $this->created_at->format('Y-m-d'),
            'updatedAt'         => $this->updated_at->format('Y-m-d'),
            'symbolType'        => $this->symbolType->title,
            // 'image'             => new ImageResource($this->symbol->image),
        ];
    }
}
