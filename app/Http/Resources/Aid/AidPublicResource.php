<?php

namespace AvisoNavAPI\Http\Resources\Aid;

use AvisoNavAPI\AidTypeForm;
use AvisoNavAPI\ColorStructure;
use AvisoNavAPI\Http\Resources\LocationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use AvisoNavAPI\Http\Resources\Aid\CoordinateResource;
use AvisoNavAPI\Http\Resources\Aid\AidTypeFormResource;
use AvisoNavAPI\Http\Resources\TopMark\TopMarkResource;
use AvisoNavAPI\Http\Resources\ColorType\ColorTypeResource;
use AvisoNavAPI\Http\Resources\LightClass\LightClassResource;
use AvisoNavAPI\Http\Resources\ColorStructure\ColorStructureResource;
use AvisoNavAPI\Http\Resources\ColorLight\ColorLightResource;

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
        $self= $this;
        $name = function() use ($self){
            return $self->symbol->symbolLang->name;
        };
        
        $observation = function() use ($self){
            return $self->symbol->symbolLang->observation;
        };

        return [
            'id'                => $this->id,
            'name'              => $this->when(!is_null($this->symbol->symbolLang), $name, null),
            'racon'             => $this->racon,
            'ais'               => $this->ais,
            'height'            => $this->height,
            'elevationNmm'      => $this->elevation_nmm,
            'scope'             => $this->scope,
            'sectorAngle'       => $this->sector_angle,
            'flashGroups'       => $this->flash_groups,
            'period'            => $this->period,
            'createdAt'        => $this->created_at->format('Y-m-d'),
            'updatedAt'        => $this->updated_at->format('Y-m-d'),
            'observation'       => $this->when(!is_null($this->symbol->symbolLang), $observation, null),
            'user'              => $this->user,
            'location'          => new LocationResource($this->symbol->location),
            'lightClass'        => new LightClassResource($this->lightClass),
            'colorStructurePattern' => new ColorStructureResource($this->colorStructurePattern),
            'topMark'           => new TopMarkResource($this->topMark),
            'aidType'           => new AidTypeResource($this->aidType),
            'aidTypeForm'       => new AidTypeFormResource($this->aidTypeForm),
            'coordinate'        => new CoordinateResource($this->coordinate->first),
            'colorStructure'    => ColorStructureResource::collection($this->aidColorStructure),
            'colorLight'        => ColorLightResource::collection($this->aidColorLight),
            'sequenceFlashes'   => SequenceFlashesResource::collection($this->sequenceFlashes),
            'links'             => [
                'self'      =>  route('aid.show', ['id' => $this->id]),
                'aidLang'   =>  route('aid.aidLang.index', ['id' => $this->id])
            ]
        ];
    }
}
