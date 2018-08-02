<?php

namespace AvisoNavAPI\Http\Resources\Aid;

use Illuminate\Http\Resources\Json\JsonResource;

class AidTypeResource extends JsonResource
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
            return $self->aidTypeLang->name;
        };

        return [
            'id'                => $this->id,
            'name'              => $this->when(!is_null($this->aidTypeLang), $name, null),
            'createdAt'        => $this->created_at->format('Y-m-d'),
            'updatedAt'        => $this->updated_at->format('Y-m-d'),
            'links'             => [
                'self'          => route('aidType.show', ['id' => $this->id]),
                'aidTypeLang'   => route('aidType.aidTypeLang.index', ['id' => $this->id])
            ]
        ];

    }
}
