<?php

namespace AvisoNavAPI\Http\Resources;

use AvisoNavAPI\Http\Resources\IdiomaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TipoColorResource extends JsonResource
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
            'tipo_color_id'     =>  $this->tipo_color_id,
            'color'             =>  $this->color,
            'alias'             =>  $this->alias,
            'cod_ide'           =>  $this->cod_ide,
            'fecha_creacion'    =>  $this->created_at->format('Y-m-d'),
            'fecha_edicion'     =>  $this->updated_at->format('Y-m-d'),
            'estado'            =>  $this->estado,
            'idioma'            =>  new IdiomaResource($this->idioma()->first()),
        ];
    }
}
