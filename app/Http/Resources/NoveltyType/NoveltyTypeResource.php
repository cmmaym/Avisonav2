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
            'created_at'        => $this->created_at->format('Y-m-d'),
            'updated_at'        => $this->updated_at->format('Y-m-d'),
            'state'             => $this->state,
            'links'              => [
                'self'  =>  route('noveltyType.show', ['id' => $this->id]),
                'noveltyTypeLang' => route('noveltyType.noveltyTypeLang.index', ['id' => $this->id]),
            ],
        ];
    }
}
