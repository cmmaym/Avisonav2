<?php

namespace AvisoNavAPI\Http\Resources\CharacterType;

use Illuminate\Http\Resources\Json\JsonResource;

class CharacterTypeLangResource extends JsonResource
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
            'links'              => [
                'self'  =>  route('characterType.characterTypeLang.show', ['characterTypeId' => $this->characterType->id,'id' => $this->id]),
                'characterType'  =>  route('characterType.show', ['id' => $this->characterType->id]),
            ]
        ];
    }
}
