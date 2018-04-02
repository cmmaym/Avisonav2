<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AyudaResource extends JsonResource
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
            'numero'            => $this->numero,
            'nombre'            => $this->nombre,
            'fecha_creacion'    => $this->created_at->format('Y-m-d'),
            'fecha_edicion'     => $this->updated_at->format('Y-m-d'),
            'estado'            => $this->estado,
            'version'           => $this->version,
            'ubicacion'         => new UbicacionResource($this->ubicacion),
            'coordenada'        => CoordenadaResource::collection($this->coordenada)
        ];
    }
}
