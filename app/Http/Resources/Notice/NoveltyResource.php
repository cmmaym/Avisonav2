<?php

namespace AvisoNavAPI\Http\Resources\Notice;

use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Collection;
use Illuminate\Pagination\AbstractPaginator;
use AvisoNavAPI\Http\Resources\SymbolResource;
use Illuminate\Http\Resources\Json\JsonResource;
use AvisoNavAPI\Http\Resources\Notice\NoveltyResource;
use AvisoNavAPI\Http\Resources\Notice\NoveltySubResource;
use AvisoNavAPI\Http\Resources\NoveltyType\NoveltyTypeResource;
use AvisoNavAPI\Http\Resources\CharacterType\CharacterTypeResource;

class NoveltyResource extends JsonResource
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

        $self = $this;
        $description = function() use ($self) {
            return $self->noveltyLang->description;
        };

        return [
            'id'                        => $this->id,
            'notice'                    => $this->notice->number,
            'noveltyType'               => new NoveltyTypeResource($this->noveltyType),
            'characterType'             => new CharacterTypeResource($this->characterType),
            'description'               =>  $this->when(!is_null($this->noveltyLang), $description, null),
            'symbol'                    => new SymbolResource($this->symbol),
            'state'                     => $this->state,
            'numItem'                   => $this->num_item,
            'createdAt'                => $this->created_at->format('Y-m-d'),
            'updatedAt'                => $this->updated_at->format('Y-m-d'),
            'parent'                    => new NoveltySubResource($this->parent),
            'child'                     => new NoveltySubResource($this->child)
        ];
    }
}
