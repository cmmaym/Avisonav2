<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IdiomaResource extends JsonResource
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
            'id'                => (string) $this->idioma_id,
            'nombre'            => $this->nombre,
            'alias'             => $this->alias,
            'fecha_creacion'    => $this->created_at->format('Y-m-d'),
            'fecha_edicion'     => $this->updated_at->format('Y-m-d'),
            'links'             => [
                'self'  =>  route('idioma.show', ['id' => $this->idioma_id]),
            ],
        ];
    }
}
