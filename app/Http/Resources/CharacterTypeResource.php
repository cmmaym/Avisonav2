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
            'created_at'        => $this->created_at->format('Y-m-d'),
            'updated'           => $this->updated_at->format('Y-m-d'),
            'state'             => $this->state,
            'links'              => [
                'self'  =>  route('characterType.show', ['id' => $this->id]),
                'characterTypeLang' => route('characterType.characterTypeLang.index', ['id' => $this->id])
            ]
        ];
    }
}
