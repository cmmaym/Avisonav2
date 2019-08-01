<?php

namespace AvisoNavAPI\Http\Resources;

use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'name'                      => $this->name,
            'createdAt'                => $this->created_at->format('Y-m-d'),
            'createdBy'                 => $this->created_by,
            'image'                      => Storage::disk('public')->url($this->image)
        ];
    }
}
