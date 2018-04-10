<?php

namespace AvisoNavAPI\Http\Resources;

use AvisoNavAPI\Traits\Responser;
use Illuminate\Support\Collection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\AbstractPaginator;

class AvisoResource extends JsonResource
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
    //     $cartas = $this->paginate($this->whenLoaded('carta'));
    //     $cartaCollection = [
    //         'data' => new CartaCollection($cartas),
    //         'links' => [
    //             ''
    //         ],
    //     ];

    $carta = (new CartaCollection($this->paginate($this->whenLoaded('carta'), 'prueba')));
    $a = $carta->toResponse($request);
    // dd($a->getData());
    // // if($this->paginate($this->whenLoaded('carta')) instanceof AbstractPaginator){
    // // }

    // return false;

        return [
            'id'                => $this->id,
            'num_aviso'         => $this->num_aviso,
            'fecha'             => $this->fecha,
            'fecha_creacion'    => $this->created_at->format('Y-m-d'),
            'fecha_edicion'     => $this->updated_at->format('Y-m-d'),
            'periodo'           => $this->periodo,
            'estado'            => $this->estado,
            'entidad'           => new EntidadResource($this->entidad),
            'aviso_detalle'     => AvisoDetalleResource::collection($this->avisoDetalle),
            'carta'             => $a->getData(),
            'ayuda'             => AyudaResource::collection($this->ayudas),
        ];
    }
}
