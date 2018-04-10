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
            'id'                => $this->id,
            'nombre'            => $this->nombre,
            'alias'             => $this->alias,
            'fecha_creacion'    => $this->created_at->format('Y-m-d'),
            'fecha_edicion'     => $this->updated_at->format('Y-m-d'),
            'estado'            => $this->estado,
            'links'             => [
                'self'  =>  route('idioma.show', ['id' => $this->id]),
            ],
        ];
    }

    /**
     * Get the original attribute
     * 
     * @return string|null
     */
    public static function getOriginalAttribute($index){
        $attributes = [
            'id'        => 'id',
            'nombre'    => 'nombre',
            'alias'     => 'alias',
            'fecha_creacion' => 'created_at'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
