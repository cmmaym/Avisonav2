<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use AvisoNavAPI\CoordenadaDetalle;

class CoordenadaResource extends JsonResource
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
            'altitud'           => $this->altitud,
            'alcance'           => $this->alcance,
            'cantidad'          => $this->cantidad,
            'version'           => $this->version,
            'fecha_creacion'    => $this->created_at->format('Y-m-d'),
            'fecha_edicion'     => $this->updated_at->format('Y-m-d'),
            'estado'            => $this->estado,
            'detalle'           => CoordenadaDetalleResource::collection($this->coordenadaDetalle)
        ];
    }
}
