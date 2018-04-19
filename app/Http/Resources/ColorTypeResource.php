<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ColorTypeResource extends JsonResource
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
            'created_at'        =>  $this->created_at->format('Y-m-d'),
            'updated_at'        =>  $this->updated_at->format('Y-m-d'),
            'state'             =>  $this->estado,
            'links'              => [
                'self'  =>  route('colorType.show', ['id' => $this->id]),
                'childs' =>  $this->when(is_null($this->parent_id), route('colorType.child.index', ['id' => $this->id])),
            ]
        ];
    }
}
