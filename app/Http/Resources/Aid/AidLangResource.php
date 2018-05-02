<?php

namespace AvisoNavAPI\Http\Resources\Aid;

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
            'description'       => $this->description,
            'created_at'        => $this->created_at->format('Y-m-d'),
            'updated_at'        => $this->updated_at->format('Y-m-d'),
            'links'             => [
                'self'          => route('aid.aidLang.show', ['aidId' => $this->aid->id, 'id' => $this->id]),
                'aid'           => route('aid.show', ['id' => $this->aid->id])
            ]
        ];
    }
}
