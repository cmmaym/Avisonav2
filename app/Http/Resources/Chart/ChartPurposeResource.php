<?php

namespace AvisoNavAPI\Http\Resources\Chart;

use Illuminate\Http\Resources\Json\JsonResource;

class ChartPurposeResource extends JsonResource
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
        $purpose = function() use ($self){
            return $self->chartPurposeLang->description;
        };

        return [
            'id'                =>  $this->id,
            'purpose'           =>  $this->when(!is_null($this->chartPurposeLang), $purpose, null),
            'createdAt'        =>   $this->created_at->format('Y-m-d'),
            'updatedAt'         => $this->updated_at->format('Y-m-d'),
            'createdBy'         => $this->created_by,
        ];
    }

}
