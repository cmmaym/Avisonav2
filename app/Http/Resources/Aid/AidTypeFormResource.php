<?php

namespace AvisoNavAPI\Http\Resources\Aid;

use Illuminate\Http\Resources\Json\JsonResource;

class AidTypeFormResource extends JsonResource
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
            return $self->aidTypeFormLang->description;
        };

        return [
            'id'                => $this->id,
            'illustration'      => $this->illustration,
            'description'       => $this->when(!is_null($this->aidTypeFormLang), $description, null),
            'createdAt'        => $this->created_at->format('Y-m-d'),
            'updatedAt'        => $this->updated_at->format('Y-m-d')
        ];

    }
}
