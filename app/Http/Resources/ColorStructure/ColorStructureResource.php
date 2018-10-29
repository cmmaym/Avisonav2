<?php

namespace AvisoNavAPI\Http\Resources\ColorStructure;

use Illuminate\Http\Resources\Json\JsonResource;

class ColorStructureResource extends JsonResource
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
            return $self->colorStructureLang->name;
        };

        return [
            'id'                =>  $this->id,
            'name'             =>  $this->when(!is_null($this->colorStructureLang), $name, null),
            'createdAt'        =>  $this->created_at->format('Y-m-d'),
            'updatedAt'        =>  $this->updated_at->format('Y-m-d'),
            'createdBy'         => $this->created_by
        ];
    }
}
