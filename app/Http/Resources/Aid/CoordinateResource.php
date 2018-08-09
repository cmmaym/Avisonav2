<?php

namespace AvisoNavAPI\Http\Resources\Aid;

use Illuminate\Http\Resources\Json\JsonResource;

class CoordinateResource extends JsonResource
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
            'latitudeDegrees'   => $this->latitude_degrees,
            'latitudeMinutes'   => $this->latitude_minutes,
            'latitudeSeconds'   => $this->latitude_seconds,
            'latitudeDir'       => $this->latitude_dir,
            'longitudeDegrees'   => $this->longitude_degrees,
            'longitudeMinutes'   => $this->longitude_minutes,
            'longitudeSeconds'   => $this->longitude_seconds,
            'longitudeDir'       => $this->longitude_dir,
            'createdAt'        => $this->created_at->format('Y-m-d'),
            'updatedAt'        => $this->updated_at->format('Y-m-d'),
            'links'             => [
                'self'  =>  route('aid.coordinate.show', ['aidId' => $this->aid->id, 'id' => $this->id]),
                'aid'   =>  route('aid.show', ['id' => $this->aid->id])
            ]
        ];
    }
}
