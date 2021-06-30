<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'numIde'       => $this->num_ide,
            'username'      => $this->username,
            'name1'         => $this->name1,
            'name2'         => $this->name2,
            'lastName1'    => $this->last_name1,
            'lastName2'    => $this->last_name2,
            'email'         => $this->email,
            'state'         => $this->state,
            'role'          => new RoleResource($this->role),
            'createdAt'         => $this->created_at->format('Y-m-d'),
            'updatedAt'         => $this->updated_at->format('Y-m-d'),
            'createdBy'     => $this->created_by,
            'firm'          => $this->firm_path ? Storage::disk('public')->url($this->firm_path) : null,
            'sign_automatically' => $this->sign_automatically
        ];
    }
}
