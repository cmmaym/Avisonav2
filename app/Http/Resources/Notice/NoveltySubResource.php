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

class NoveltySubResource extends JsonResource
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
        $name = function() use ($self) {
            return $self->noveltyLang->name;
        };

        $symbol = function() use ($self) {
            return $self->symbol->symbol;
        };

        return [
            'id'                        => $this->id,
            'name'                      =>  $this->when(!is_null($this->noveltyLang), $name, null),
            'notice'                    => $this->notice->number,
            'noveltyType'               => new NoveltyTypeResource($this->noveltyType),
            'characterType'             => new CharacterTypeResource($this->characterType),
            // 'symbol'                    => new SymbolResource($this->when(!is_null($this->symbol), $symbol, null)),
            'state'                     => $this->state,
            'numItem'                   => $this->num_item,
            'createdAt'                => $this->created_at->format('Y-m-d'),
            'updatedAt'                => $this->updated_at->format('Y-m-d')
        ];
    }
}
