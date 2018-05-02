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
            'type'              => $this->type,
            'illustration'      => $this->illustration,
            'created_at'        => $this->created_at->format('Y-m-d'),
            'updated_at'        => $this->updated_at->format('Y-m-d'),
            'state'             => $this->state,
            'links'             => [
                'self'          => route('aidType.show', ['id' => $this->id]),
                'aidTypeLang'   => route('aidType.aidTypeLang.index', ['id' => $this->id])
            ]
        ];

    }
}
