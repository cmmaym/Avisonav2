<?php

namespace AvisoNavAPI\Http\Resources\Notice;

use Illuminate\Http\Resources\Json\JsonResource;
use AvisoNavAPI\Http\Resources\LanguageResource;

class NoticeLangResource extends JsonResource
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
            'observation'       => $this->observation,
            'created_at'        => $this->created_at->format('Y-m-d'),
            'updated_at'        => $this->updated_at->format('Y-m-d'),
            'language'          => new LanguageResource($this->language),
            'links'             => [
                'self'      =>  route('notice.noticeLang.show', [$this->notice->id, $this->id]),
            ]
        ];
    }
}
