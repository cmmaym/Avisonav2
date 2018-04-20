<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AidDetailResource extends JsonResource
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
            'description'       => $this->description,
            'observation'       => $this->observation,
            'created_at'        => $this->created_at->format('Y-m-d'),
            'updated_at'        => $this->updated_at->format('Y-m-d'),
            'state'             => $this->state,
            'light_type'        => new LightTypeResource($this->lightType),
            'color_type'        => new ColorTypeResource($this->colorType),
            'novelty_type'      => new NoveltyTypeResource($this->noveltyType),
            'coordinate'        => new CoordinateResource($this->coordinate)
        ];
    }
}
