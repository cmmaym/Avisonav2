<?php

namespace AvisoNavAPI\Http\Resources\Aid;

use AvisoNavAPI\Http\Resources\LanguageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AidTypeLangResource extends JsonResource
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
            'links'             => [
                'self'          => route('aidType.aidTypeLang.show', ['aidTypeId' => $this->aidType->id, 'id' => $this->id]),
                'aidType'       => route('aidType.show', ['id' => $this->aidType->id])
            ]
        ];
    }
}
