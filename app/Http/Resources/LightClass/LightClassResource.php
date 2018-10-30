<?php

namespace AvisoNavAPI\Http\Resources\LightClass;

use Illuminate\Http\Resources\Json\JsonResource;

class LightClassResource extends JsonResource
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
            return $self->lightClassLang->class;
        };
        
        $description = function() use ($self){
            return $self->lightClassLang->description;
        };

        return [
            'id'                =>  $this->id,
            'alias'             =>  $this->alias,
            'class'             =>  $this->when(!is_null($this->lightClassLang), $class, null),
            'description'       =>  $this->when(!is_null($this->lightClassLang), $description, null),
            'illustration'      =>  $this->illustration,
            'createdAt'        =>  $this->created_at->format('Y-m-d'),
            'updatedAt'        =>  $this->updated_at->format('Y-m-d'),
            'createdBy'         => $this->created_by
        ];
    }
}
