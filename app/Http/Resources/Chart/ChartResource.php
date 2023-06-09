<?php

namespace AvisoNavAPI\Http\Resources\Chart;

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
            'name'              =>  $this->name,
            'number'            =>  $this->number,
            'scale'             =>  $this->scale,
            'purpose'           =>  $this->purpose,
            'createdAt'        =>   $this->created_at->format('Y-m-d'),
            'createdBy'         => $this->created_by,
            'area'              =>  $this->area,
            'purpose'           => new ChartPurposeResource($this->chartPurpose),
            'isLegacy'          => $this->is_legacy
        ];
    }

}
