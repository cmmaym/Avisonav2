<?php

namespace AvisoNavAPI\Http\Resources;

use AvisoNavAPI\Http\Resources\ImageResource;
use AvisoNavAPI\Http\Resources\LocationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use AvisoNavAPI\Http\Resources\Aid\CoordinateResource;
use AvisoNavAPI\Http\Resources\Aid\AidPublicResource;

class SymbolPublicResource extends JsonResource
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
        $name = function() use ($self){
            return $self->symbolLang->name;
        };

        return [
            'id'                => $this->id,
            'name'              => $this->when(!is_null($this->symbolLang), $name, null),
            'createdAt'         => $this->created_at->format('Y-m-d'),
            'updatedAt'         => $this->updated_at->format('Y-m-d'),
            'image'             => new ImageResource($this->image),
            'aidFeatures'       => new AidPublicResource($this->aid),
            'isLegacy'          => $this->is_legacy
        ];
    }
}
