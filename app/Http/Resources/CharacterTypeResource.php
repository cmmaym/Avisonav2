<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CharacterTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'created_at'        => $this->created_at->format('Y-m-d'),
            'updated'           => $this->updated_at->format('Y-m-d'),
            'state'             => $this->state,
            'links'              => [
                'self'  =>  route('characterType.show', ['id' => $this->id]),
                'childs' =>  $this->when(is_null($this->parent_id), route('characterType.child.index', ['id' => $this->id])),
            ]
        ];
    }
}
