<?php

namespace AvisoNavAPI\Http\Resources\TopMark;

use AvisoNavAPI\Http\Resources\LanguageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TopMarkLangResource extends JsonResource
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
            'id'                =>  $this->id,
            'description'       =>  $this->description,
            'createdAt'        =>  $this->created_at->format('Y-m-d'),
            'updatedAt'        =>  $this->updated_at->format('Y-m-d'),
            'language'          => new LanguageResource($this->language),
            'links'             => [
                'self'  =>  route('topMark.topMarkLang.show', ['topMarkId' => $this->topMark->id, 'id' => $this->id]),
                'topMark' => route('topMark.show', ['id' => $this->topMark->id])
            ]
        ];
    }
}
