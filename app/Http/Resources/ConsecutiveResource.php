<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsecutiveResource extends JsonResource
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
            'id'        => $this->id,
            'number'    => $this->number,
            'year'      => $this->year,
            'createdAt' => $this->created_at->format('Y-m-d'),
            'createdBy' => $this->created_by
        ];
    }
}
