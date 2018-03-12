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
            'fecha_creacion'    => $this->created_at,
            'fecha_edicion'     => $this->updated_at,
            'links'             => [
                'self'  =>  route('idioma.show', ['id' => $this->idioma_id]),
            ],
        ];
    }
}
