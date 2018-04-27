<?php

namespace AvisoNavAPI\Http\Resources\Notice;

use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Collection;
use Illuminate\Pagination\AbstractPaginator;
use AvisoNavAPI\Http\Resources\EntityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class NoticeSimpleResource extends JsonResource
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
            'year'                      => $this->year,
            'created_at'                => $this->created_at->format('Y-m-d'),
            'updated_at'                => $this->updated_at->format('Y-m-d'),
            'state'                     => $this->state,
            'file_info'                 => $this->file_info,
            'characterType'             => $this->characterType->characterTypeLang->name,
            'entity'                    => new EntityResource($this->entity),
            'links'                     => [
                'self'      =>  route('notice.show', ['id' => $this->id, 'language' => $request->input('language')]),
                'noticeLang' => route('notice.noticeLang.index', ['id' => $this->id])
            ]
        ];
    }
}
