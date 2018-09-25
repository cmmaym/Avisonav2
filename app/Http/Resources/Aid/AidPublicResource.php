<?php

namespace AvisoNavAPI\Http\Resources\Aid;

use AvisoNavAPI\AidTypeForm;
use AvisoNavAPI\ColorStructure;
use AvisoNavAPI\Http\Resources\LocationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use AvisoNavAPI\Http\Resources\Aid\CoordinateResource;
use AvisoNavAPI\Http\Resources\Aid\AidTypeFormResource;
use AvisoNavAPI\Http\Resources\SequenceFlashesResource;
use AvisoNavAPI\Http\Resources\TopMark\TopMarkResource;
use AvisoNavAPI\Http\Resources\ColorType\ColorTypeResource;
use AvisoNavAPI\Http\Resources\ColorLight\ColorLightResource;
use AvisoNavAPI\Http\Resources\LightClass\LightClassResource;
use AvisoNavAPI\Http\Resources\ColorStructure\ColorStructureResource;

class AidPublicResource extends JsonResource
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
            'height'            => $this->height->structure_height,
            'scope'             => $this->nominalScope->scope,
            'period'            => $this->period->time,
            'createdAt'        => $this->created_at->format('Y-m-d'),
            'updatedAt'        => $this->updated_at->format('Y-m-d'),
            'colorStructurePattern' => new ColorStructureResource($this->colorStructurePattern),
            'aidTypeForm'       => new AidTypeFormResource($this->aidTypeForm),
            'topMark'           => new TopMarkResource($this->topMark),
            'sequenceFlashes'   => SequenceFlashesResource::collection($this->period->sequenceFlashes),
        ];
    }
}
