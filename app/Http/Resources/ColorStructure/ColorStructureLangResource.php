<?php

namespace AvisoNavAPI\Http\Resources\ColorStructure;

use AvisoNavAPI\Http\Resources\LanguageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ColorStructureLangResource extends JsonResource
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
            'name'             =>  $this->name,
            'createdAt'        =>  $this->created_at->format('Y-m-d'),
            'updatedAt'        =>  $this->updated_at->format('Y-m-d'),
            'language'          => new LanguageResource($this->language),
            'links'             => [
                'self'  =>  route('colorStructure.colorStructureLang.show', ['colorStructureId' => $this->colorStructure->id, 'id' => $this->id]),
                'colorStructure' => route('colorStructure.show', ['id' => $this->colorStructure->id])
            ]
        ];
    }
}
