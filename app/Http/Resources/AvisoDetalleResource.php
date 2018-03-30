<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AvisoDetalleResource extends JsonResource
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
            'id'    =>  $this->id,
            'observacion'   =>  $this->observacion,
            'estado'        =>  $this->estado,
            'tipo_aviso'    =>  $this->tipoAviso,
            'tipo_caracter' =>  $this->tipoCaracter,
            'idioma'        =>  $this->idioma
        ];
    }
}
