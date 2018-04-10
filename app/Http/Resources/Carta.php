<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Carta extends JsonResource
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
            'numero'            =>  $this->numero,
            'edicion'           =>  $this->edicion,
            'año'               =>  $this->ano,
            'fecha_creacion'    => $this->created_at->format('Y-m-d'),
            'fecha_edicion'     => $this->updated_at->format('Y-m-d'),
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
            'numero'    => 'numero',
            'edicion'     => 'edicion',
            'año'     => 'año',
            'fecha_creacion' => 'created_at'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
