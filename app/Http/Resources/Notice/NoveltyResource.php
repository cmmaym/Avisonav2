<?php

namespace AvisoNavAPI\Http\Resources\Notice;

use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Collection;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Http\Resources\Json\JsonResource;
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
        
        $symbolName = function() use ($self) {
            if(!is_null($self->symbol->symbolLang))
            {
                return $self->symbol->symbolLang->name;
            }

            return null;
        };

        return [
            'id'                        => $this->id,
            'notice'                    => $this->notice->number,
            'noveltyType'               => new NoveltyTypeResource($this->noveltyType),
            'characterType'             => new CharacterTypeResource($this->characterType),
            'description'               =>  $this->when(!is_null($this->noveltyLang), $description, null),
            'symbol'                    => $this->when(!is_null($this->symbol), $symbolName, null),
            'createdAt'                => $this->created_at->format('Y-m-d'),
            'updatedAt'                => $this->updated_at->format('Y-m-d')
        ];
    }
}
