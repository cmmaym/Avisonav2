<?php

namespace AvisoNavAPI\Http\Resources;

use AvisoNavAPI\Http\Resources\IdiomaResource;
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
            'id'                =>  $this->id,
            'clase'             =>  $this->clase,
            'alias'             =>  $this->alias,
            'descripcion'       =>  $this->descripcion,
            'illustracion'      =>  $this->illustracion,            
            'fecha_creacion'    =>  $this->created_at->format('Y-m-d'),
            'fecha_edicion'     =>  $this->updated_at->format('Y-m-d'),
            'estado'            =>  $this->estado,
            'idioma'            =>  new IdiomaResource($this->idioma()->first()),
            'sub_tipo_luz'      =>  TipoLuzResource::collection($this->tipoLuz()->get()),
        ];
    }
}
