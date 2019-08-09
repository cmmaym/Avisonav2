<?php

namespace AvisoNavAPI\Http\Resources\Aid;

use AvisoNavAPI\Http\Resources\HeightResource;
use AvisoNavAPI\Http\Resources\LocationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use AvisoNavAPI\Http\Resources\NominalScopeResource;
use AvisoNavAPI\Http\Resources\SequenceFlashesResource;
use AvisoNavAPI\Http\Resources\ColorLight\ColorLightResource;
use AvisoNavAPI\Http\Resources\ColorStructure\ColorStructureResource;
use AvisoNavAPI\Http\Resources\Chart\ChartResource;

class AidMapResource extends JsonResource
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

        $aidTypeForm = function() use ($self){
            return $self->aidTypeForm->aidTypeFormLang->description;
        };

        $colorPattern = function() use ($self){
            return $self->colorStructurePattern->colorStructureLang->name;
        };

        $topMark = function() use ($self){
            return $self->topMark->topMarkLang ? $self->topMark->topMarkLang->description : null;
        };

        $lightClass = function() use ($self){
            return '('.$self->lightClass->alias.') '.$self->lightClass->lightClassLang->class;
        };
        
        return [
            'id'                => $this->id,
            'name'              => $this->when(!is_null($this->symbol->symbolLang), $name, null),
            'location'          => new LocationResource($this->symbol->location),
            'aidTypeForm'       => $this->when(!is_null($this->aidTypeForm->aidTypeFormLang), $aidTypeForm, null),
            'colorPattern'      => $this->when(!is_null($this->colorStructurePattern->colorStructureLang), $colorPattern, null),
            'topMark'           => $this->when(!is_null($this->topMark), $topMark, null),
            'lightClass'        => $this->when(!is_null($this->lightClass->lightClassLang), $lightClass, null),
            'colorStructure'    => ColorStructureResource::collection($this->aidColorStructure),
            'colorLight'        => ColorLightResource::collection($this->aidColorLight),
            'height'            => new HeightResource($this->height),
            'nominalScope'      => new NominalScopeResource($this->nominalScope),
            'period'            => ($this->period) ? $this->period->time : null,
            'sequenceFlashes'   => ($this->period) ? SequenceFlashesResource::collection($this->period->sequenceFlashes) : null,
            'chart'             => ChartResource::collection($this->symbol->chart),
            'spatialData'       => $this->symbol->position
        ];
    }
}
