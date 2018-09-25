<?php

namespace AvisoNavAPI\Http\Resources\Notice;

use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Collection;
use Illuminate\Pagination\AbstractPaginator;
use AvisoNavAPI\Http\Resources\SymbolResource;
use Illuminate\Http\Resources\Json\JsonResource;
use AvisoNavAPI\Http\Resources\Notice\NoveltyResource;
use AvisoNavAPI\Http\Resources\NoveltyType\NoveltyTypeResource;
use AvisoNavAPI\Http\Resources\CharacterType\CharacterTypeResource;

class NoveltySubPublicResource extends JsonResource
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
            'notice'                    => $this->notice->number,
            'numItem'                   => $this->num_item,
            'createdAt'                => $this->created_at->format('Y-m-d'),
            'updatedAt'                => $this->updated_at->format('Y-m-d')
        ];
    }
}
