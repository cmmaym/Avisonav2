<?php

namespace AvisoNavAPI\Http\Resources\Chart;

use Illuminate\Http\Resources\Json\JsonResource;

class ChartEditionResource extends JsonResource
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
            'scale'             => $this->scale,
            'edition'           => $this->edition,
            'year'              => $this->year,
            'createdAt'         =>  $this->created_at->format('Y-m-d'),
            'updatedAt'         =>  $this->updated_at->format('Y-m-d'),
            'state'             => $this->state,
            'chart'             => new ChartResource($this->chart)
        ];
    }
}
