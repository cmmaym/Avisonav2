<?php

namespace AvisoNavAPI\Http\Resources\NoveltyType;

use AvisoNavAPI\Http\Resources\LanguageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class NoveltyTypeLangResource extends JsonResource
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
            'updated_at'        => $this->updated_at->format('Y-m-d'),
            'language'          => new LanguageResource($this->language),
            'links'              => [
                'self'  =>  route('noveltyType.noveltyTypeLang.show', ['noveltyTypeId' => $this->noveltyType->id, 'id' => $this->id]),
                'noveltyType'  =>  route('noveltyType.show', ['noveltyTypeId' => $this->noveltyType->id]),
            ],
        ];
    }
}
