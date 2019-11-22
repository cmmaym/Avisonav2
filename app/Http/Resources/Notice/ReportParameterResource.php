<?php

namespace AvisoNavAPI\Http\Resources\Notice;

use AvisoNavAPI\Traits\Responser;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ReportParameterResource extends JsonResource
{
    use Responser;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                        => $this->id,
            'namePerson1'               => $this->name_person1,
            'namePerson2'               => $this->name_person2,
            'namePerson3'               => $this->name_person3,
            'firmPerson1'               => $this->firm_person1 ? Storage::disk('public')->url($this->firm_person1) : null,
            'firmPerson2'               => $this->firm_person2 ? Storage::disk('public')->url($this->firm_person2) : null,
            'firmPerson3'               => $this->firm_person3 ? Storage::disk('public')->url($this->firm_person3) : null,
        ];
    }
}
