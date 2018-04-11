<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UbicacionResource extends JsonResource
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
            'ubicacion'         =>  $this->ubicacion,
            'sub_ubicacion'     =>  $this->sub_ubicacion,
            'fecha_creacion'    =>  $this->created_at->format('Y-m-d'),
            'fecha_edicion'     =>  $this->updated_at->format('Y-m-d'),
            'estado'            =>  $this->estado,
            'zona'              =>  new ZonaResource($this->zona),
        ];
    }
}
