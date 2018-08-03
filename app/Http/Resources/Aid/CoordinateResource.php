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
            'latitud'           => $this->latitud,
            'longitud'          => $this->longitud,
            'createdAt'        => $this->created_at->format('Y-m-d'),
            'updatedAt'        => $this->updated_at->format('Y-m-d'),
            'links'             => [
                'self'  =>  route('aid.coordinate.show', ['aidId' => $this->aid->id, 'id' => $this->id]),
                'aid'   =>  route('aid.show', ['id' => $this->aid->id])
            ]
        ];
    }
}
