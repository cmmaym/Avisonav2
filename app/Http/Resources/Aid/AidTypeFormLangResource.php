<?php

namespace AvisoNavAPI\Http\Resources\Aid;

use AvisoNavAPI\Http\Resources\LanguageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AidTypeFormLangResource extends JsonResource
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
            'description'       => $this->description,
            'createdAt'        => $this->created_at->format('Y-m-d'),
            'updatedAt'        => $this->updated_at->format('Y-m-d'),
            'language'          => new LanguageResource($this->language),
            'links'             => [
                'self'          => route('aidTypeForm.aidTypeFormLang.show', ['aidTypeId' => $this->aidType->id, 'id' => $this->id]),
                'aidType'           => route('aidType.show', ['id' => $this->aidType->id])
            ]
        ];
    }
}
