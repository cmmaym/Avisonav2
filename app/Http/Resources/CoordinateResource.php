<?php

namespace AvisoNavAPI\Http\Resources;

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
            'latitud'           => $this->latitud,
            'longitud'          => $this->longitud,
            'created_at'        => $this->created_at->format('Y-m-d'),
            'updated_at'        => $this->updated_at->format('Y-m-d'),
            'state'             => $this->state,
            'links'             => [
                'self'  =>  route('coordinate.show', ['id' => $this->id])
            ]
        ];
    }
}
