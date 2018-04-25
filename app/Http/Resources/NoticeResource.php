<?php

namespace AvisoNavAPI\Http\Resources;

use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Collection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\AbstractPaginator;

class NoticeResource extends JsonResource
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
            'number'                    => $this->number,
            'date'                      => $this->date,
            'created_at'                => $this->created_at->format('Y-m-d'),
            'updated_at'                => $this->updated_at->format('Y-m-d'),
            'periodo'                   => $this->periodo,
            'state'                     => $this->state,
            'file_info'                 => $this->file_info,
            'entity'                    => new EntityResource($this->entity),
            'characterType'             => new CharacterTypeLangResource($this->characterType->characterTypeLang),
            'links'                     => [
                'self'      =>  route('notice.show', ['id' => $this->id]),
                'noticeLang'    =>  route('notice.noticeLang.index', ['id' => $this->id]),
            ]
        ];
    }
}
