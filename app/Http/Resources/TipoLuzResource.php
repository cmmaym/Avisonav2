<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TipoLuzResource extends JsonResource
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
            'tipo_luz_id'       =>  $this->tipo_luz_id,
            'clase'             =>  $this->clase,
            'alias'             =>  $this->alias,
            'descripcion'       =>  $this->descripcion,
            'illustracion'      =>  $this->illustracion,
            'cod_ide'           =>  $this->cod_ide,
            'fecha_creacion'    =>  $this->created_at->format('Y-m-d'),
            'fecha_edicion'     =>  $this->updated_at->format('Y-m-d'),
            'estado'            =>  $this->estado,
            'idioma'            =>  new IdiomaResource($this->idioma()->first()),
        ];
    }
}
