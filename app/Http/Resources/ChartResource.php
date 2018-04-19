<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChartResource extends JsonResource
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
            'id'                =>  $this->id,
            'number'            =>  $this->number,
            'purpose'           =>  $this->purpose,
            'created_at'        =>  $this->created_at->format('Y-m-d'),
            'updated_at'        =>  $this->updated_at->format('Y-m-d'),
            'state'             => $this->state,
            'edition'           => ChartEditionResource::collection($this->chartEdition),
            'links'             => [
                'self'  =>  route('chart.show', ['id' => $this->id])
            ]
        ];
    }

}
