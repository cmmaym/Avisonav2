<?php

namespace AvisoNavAPI\Http\Resources\NoveltyType;

use Illuminate\Http\Resources\Json\JsonResource;

class NoveltyTypeResource extends JsonResource
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
            return $self->noveltyTypeLang->name;
        };
        
        $description = function() use ($self){
            return $self->noveltyTypeLang->description;
        };

        return [
            'id'                => $this->id,
            'name'              => $this->when(!is_null($this->noveltyTypeLang), $name, null),
            'description'       => $this->when(!is_null($this->noveltyTypeLang), $description, null),
            'createdAt'        => $this->created_at->format('Y-m-d'),
            'updatedAt'        => $this->updated_at->format('Y-m-d'),
            'createdBy'         => $this->created_by,
            'isLegacy'          => $this->is_legacy
        ];
    }
}
