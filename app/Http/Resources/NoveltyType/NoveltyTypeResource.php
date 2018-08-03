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

        return [
            'id'                => $this->id,
            'name'              => $this->when(!is_null($this->noveltyTypeLang), $name, null),
            'createdAt'        => $this->created_at->format('Y-m-d'),
            'updatedAt'        => $this->updated_at->format('Y-m-d'),
            'state'             => $this->state,
            'links'              => [
                'self'  =>  route('noveltyType.show', ['id' => $this->id]),
                'noveltyTypeLang' => route('noveltyType.noveltyTypeLang.index', ['id' => $this->id]),
            ],
        ];
    }
}
