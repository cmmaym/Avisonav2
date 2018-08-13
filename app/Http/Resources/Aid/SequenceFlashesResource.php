<?php

namespace AvisoNavAPI\Http\Resources\Aid;

use Illuminate\Http\Resources\Json\JsonResource;

class SequenceFlashesResource extends JsonResource
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
            'on'                => $this->on,
            'off'                => $this->off,
            'createdAt'        => $this->created_at->format('Y-m-d'),
            'updatedAt'        => $this->updated_at->format('Y-m-d'),
            'links'             => [
                'self'  =>  route('aid.sequenceFlashes.show', ['aidId' => $this->aid->id, 'id' => $this->id]),
                'aid'   =>  route('aid.show', ['id' => $this->aid->id])
            ]
        ];
    }
}
