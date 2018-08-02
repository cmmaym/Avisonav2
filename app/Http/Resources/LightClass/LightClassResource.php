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
            'createdAt'        =>  $this->created_at->format('Y-m-d'),
            'updatedAt'        =>  $this->updated_at->format('Y-m-d'),
            'links'              => [
                'self'  =>  route('lightClass.show', ['id' => $this->id]),
                'lightClassLang' => route('lightClass.lightClassLang.index', ['id' => $this->id])
            ]
        ];
    }
}
