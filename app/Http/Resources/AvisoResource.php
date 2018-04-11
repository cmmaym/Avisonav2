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

    $carta = (new CartaCollection($this->manualPaginate($this->carta, route('aviso.carta.index', ['id' => $this->id]))))
             ->toResponse($request)
             ->getData();

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
            'carta'             => $carta,
            'ayuda'             => AyudaResource::collection($this->ayudas),
        ];
    }
}
