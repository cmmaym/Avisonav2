<?php

namespace AvisoNavAPI\Http\Resources\Aid;

use AvisoNavAPI\AidTypeForm;
use AvisoNavAPI\ColorStructure;
use AvisoNavAPI\Http\Resources\LocationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use AvisoNavAPI\Http\Resources\Aid\AidTypeFormResource;
use AvisoNavAPI\Http\Resources\SequenceFlashesResource;
use AvisoNavAPI\Http\Resources\TopMark\TopMarkResource;
use AvisoNavAPI\Http\Resources\ColorLight\ColorLightResource;
use AvisoNavAPI\Http\Resources\LightClass\LightClassResource;
use AvisoNavAPI\Http\Resources\ColorStructure\ColorStructureResource;

class AidPublicResource extends JsonResource
{
    protected $is_light_properties_visible;

    public function setIsLightPropertiesVisible($value){
        $this->is_light_properties_visible = $value;
        return $this;
    }

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
            'height'            => ($this->height) ? $this->height->elevation : null,
            'scope'             => ($this->nominalScope) ? $this->nominalScope->scope : null,
            'period'            => ($this->period && $this->is_light_properties_visible) ? $this->period->time : null,
            'flashGroup'        => ($this->period && $this->is_light_properties_visible) ? $this->period->flash_group : null,
            'createdAt'        => $this->created_at->format('Y-m-d'),
            'updatedAt'        => $this->updated_at->format('Y-m-d'),
            'lightClass'        => $this->is_light_properties_visible ? new  LightClassResource($this->lightClass) : null,
            'colorStructurePattern' => new ColorStructureResource($this->colorStructurePattern),
            'colorLight'        => $this->is_light_properties_visible ? ColorLightResource::collection($this->aidColorLight) :  [],
            'aidTypeForm'       => new AidTypeFormResource($this->aidTypeForm),
            'topMark'           => new TopMarkResource($this->topMark),
            'sequenceFlashes'   => ($this->period) ? SequenceFlashesResource::collection($this->period->sequenceFlashes) : null,
            'legacyPeriod'      => $this->legacy_period,
            'legacyDestello'    => $this->legacy_destello
        ];
    }
}
