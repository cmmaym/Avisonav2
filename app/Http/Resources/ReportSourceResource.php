<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportSourceResource extends JsonResource
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
            'id'            => $this->id,
            'name'          => $this->name,
            'alias'         => $this->alias,
            'createdAt'    => $this->created_at->format('Y-m-d'),
            'updatedAt'    => $this->updated_at->format('Y-m-d'),
            'createdBy'     => $this->created_by
        ];
    }
}
