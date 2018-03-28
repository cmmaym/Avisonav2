<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AvisoResource extends JsonResource
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
            'id'    =>   $this->id,
            'num_aviso' => $this->num_aviso,
            'fecha' => $this->fecha,
            'fecha_creacion'    => $this->created_at->format('Y-m-d'),
            'fecha_edicion'     => $this->updated_at->format('Y-m-d'),
            'periodo'   => $this->periodo,
            'estado'    => $this->estado,
            'entidad'   => $this->entidad->first()->nombre,
            'aviso_detalle' => $this->avisoDetalle()->get(),
            'carta' => $this->carta()->get()
        ];
    }
}
