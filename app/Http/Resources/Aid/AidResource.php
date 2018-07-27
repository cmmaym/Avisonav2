<?php

namespace AvisoNavAPI\Http\Resources\Aid;

use AvisoNavAPI\Http\Resources\LocationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use AvisoNavAPI\Http\Resources\Aid\CoordinateResource;
use AvisoNavAPI\Http\Resources\ColorType\ColorTypeResource;
use AvisoNavAPI\Http\Resources\LightType\LightTypeResource;

class AidResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $self= $this;
        $description = function() use ($self){
            return $self->aidLang->description;
        };

        return [
            'id'                => $this->id,
            'number'            => $this->number,
            'sub_name'          => $this->sub_name,
            'elevation'         => $this->elevation,
            'scope'             => $this->scope,
            'quantity'          => $this->quantity,
            'description'       => $this->when(!is_null($this->aidLang), $description, null),
            'created_at'        => $this->created_at->format('Y-m-d'),
            'updated_at'        => $this->updated_at->format('Y-m-d'),
            'state'             => $this->state,
            'aidType'           => new AidTypeResource($this->aidType),
            'coordinate'        => new CoordinateResource($this->coordinate),
            'location'          => new LocationResource($this->location),
            'lightType'         => new LightTypeResource($this->lightType),
            'colorType'         => new ColorTypeResource($this->colorType),
            'links'             => [
                'self'      =>  route('aid.show', ['id' => $this->id]),
                'aidLang'   =>  route('aid.aidLang.index', ['id' => $this->id])
            ]
        ];
    }
}
