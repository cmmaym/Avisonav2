<?php

namespace AvisoNavAPI\Http\Resources\Notice;

use Illuminate\Http\Resources\Json\JsonResource;
use AvisoNavAPI\Http\Resources\LanguageResource;

class NoveltyLangResource extends JsonResource
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
            'name'             => $this->name,
            'createdAt'        => $this->created_at->format('Y-m-d'),
            'updatedAt'        => $this->updated_at->format('Y-m-d'),
            'language'          => new LanguageResource($this->language)
        ];
    }
}
