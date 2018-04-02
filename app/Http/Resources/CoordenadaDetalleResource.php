<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CoordenadaDetalleResource extends JsonResource
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
            'descripcion'       => $this->descripcion,
            'observacion'       => $this->observacion,
            'fecha_creacion'    => $this->created_at->format('Y-m-d'),
            'fecha_edicion'     => $this->updated_at->format('Y-m-d'),
            'estado'            => $this->estado,
            'tipo_luz'          => new TipoLuzResource($this->tipoLuz),
            'tipo_color'        => new TipoColorResource($this->tipocolor),
            'idioma'            => new IdiomaResource($this->idioma)
        ];
    }
}
