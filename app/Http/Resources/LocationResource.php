<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use AvisoNavAPI\Http\Resources\Zone\ZoneResource;

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
            'subLocationName'     =>  $this->sub_location_name,
            'createdAt'             =>  $this->created_at->format('Y-m-d'),
            'updatedAt'             =>  $this->updated_at->format('Y-m-d'),
            'zone'                  =>  new ZoneResource($this->zone)
        ];
    }
}
