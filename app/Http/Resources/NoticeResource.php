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

    // $carta = (new CartaCollection($this->manualPaginate($this->carta, route('aviso.carta.index', ['id' => $this->id]))))
    //          ->toResponse($request)
    //          ->getData();

        return [
            'id'                => $this->id,
            'number'            => $this->number,  
            'date'              => $this->date,
            'created_at'        => $this->created_at->format('Y-m-d'),
            'updated_at'        => $this->updated_at->format('Y-m-d'),
            'periodo'           => $this->periodo,
            'state'             => $this->state, 
            'entity'            => new EntityResource($this->entity),
            'links'             => [
                'self'      =>  route('notice.show', ['id' => $this->id]),
                'detail'    =>  route('notice.noticeDetail.index', ['id' => $this->id]),
            ]
        ];
    }
}
