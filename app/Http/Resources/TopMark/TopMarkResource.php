<?php

namespace AvisoNavAPI\Http\Resources\TopMark;

use Illuminate\Http\Resources\Json\JsonResource;

class TopMarkResource extends JsonResource
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
        $description = function() use ($self){
            return $self->topMarkLang->description;
        };

        return [
            'id'                =>  $this->id,
            'illustration'      => $this->illustration,
            'description'       => $this->when(!is_null($this->topMarkLang), $description, null),
            'createdAt'        =>  $this->created_at->format('Y-m-d'),
            'updatedAt'        =>  $this->updated_at->format('Y-m-d'),
            'createdBy'         => $this->created_by
        ];
    }
}
