<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'            => $this->id,
            'num_ide'       => $this->num_ide,
            'username'      => $this->username,
            'name1'         => $this->name1,
            'name2'         => $this->name2,
            'last_name1'    => $this->last_name1,
            'last_name2'    => $this->last_name2,
            'email'         => $this->email,
            'state'         => $this->state,
            'links'         => [
                'self'  => route('user.show', ['id' => $this->id])
            ]
        ];
    }
}
