<?php

namespace AvisoNavAPI\Http\Resources\LightClass;

use AvisoNavAPI\Http\Resources\LanguageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LightClassLangResource extends JsonResource
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
            'class'             =>  $this->class,
            'description'       =>  $this->description,
            'createdAt'        =>  $this->created_at->format('Y-m-d'),
            'updatedAt'        =>  $this->updated_at->format('Y-m-d'),
            'language'          => new LanguageResource($this->language),
            'links'              => [
                'self'  =>  route('lighClass.lighClassLang.show', ['lighClassId' => $this->lighClass->id, 'id' => $this->id]),
                'lighClass' => route('lighClass.show', ['id' => $this->lighClass->id])
            ]
        ];
    }
}
