<?php

namespace AvisoNavAPI\Http\Resources\Aid;

use AvisoNavAPI\Http\Resources\LanguageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AidLangResource extends JsonResource
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
            'createdAt'        => $this->created_at->format('Y-m-d'),
            'updatedAt'        => $this->updated_at->format('Y-m-d'),
            'language'          => new LanguageResource($this->language),
            'links'             => [
                'self'          => route('aid.aidLang.show', ['aidId' => $this->aid->id, 'id' => $this->id]),
                'aid'           => route('aid.show', ['id' => $this->aid->id])
            ]
        ];
    }
}
