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
            'observacion'   => $this->observacion,
            'periodo'   => $this->periodo,
            'estado'    => $this->estado,
            'entidad'   => $this->entidad->first()->nombre,
            'caracter'  => $this->tipoCaracter->first()->nombre,
            'tipo_aviso' => $this->tipoAviso->first()->nombre,
            'carta' =>   $this->carta()->get()->toArray(),
            'idioma'    => $this->idioma()->first()->nombre,
//            'sub_aviso' => AvisoResource::collection($this->aviso()->get()),
        ];
    }
}
