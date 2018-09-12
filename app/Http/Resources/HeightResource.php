<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Support\Collection;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Http\Resources\Json\JsonResource;

class HeightResource extends JsonResource
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
            'id'                        => $this->id,
            'structureHeight'           => $this->structure_height,
            'elevation'                 => $this->elevation,
            'createdAt'                => $this->created_at->format('Y-m-d'),
            'state'                     => $this->state
        ];
    }
}
