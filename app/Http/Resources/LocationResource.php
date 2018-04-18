<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'id'                    =>  $this->id,
            'name'                  =>  $this->name,
            'sub_location_name'     =>  $this->sub_location_name,
            'fecha_creacion'        =>  $this->created_at->format('Y-m-d'),
            'fecha_edicion'         =>  $this->updated_at->format('Y-m-d'),
            'state'                 =>  $this->state,
            'zone'                  =>  new ZoneResource($this->zone),
            'links'              => [
                'self'  =>  route('location.show', ['id' => $this->id]),
            ],
        ];
    }
}
