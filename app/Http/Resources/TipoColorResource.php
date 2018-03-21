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
            'id'                =>  $this->id,
            'color'             =>  $this->color,
            'alias'             =>  $this->alias,            
            'fecha_creacion'    =>  $this->created_at->format('Y-m-d'),
            'fecha_edicion'     =>  $this->updated_at->format('Y-m-d'),
            'estado'            =>  $this->estado,
            'idioma'            =>  new IdiomaResource($this->idioma()->first()),
        ];
    }
}
