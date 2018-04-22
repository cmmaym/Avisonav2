<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoticeDetailResource extends JsonResource
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
            'state'             => $this->state,
            'character_type'    => new CharacterTypeResource($this->characterType),
            'links'             => [
                'self'      =>  route('notice.noticeDetail.show', [$this->notice->id, $this->id]),
            ]
        ];
    }
}
