<?php

namespace AvisoNavAPI\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CartaCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return [
        //         'data' => $this->collection,
        //         'links' => [
        //             'first' => $this->collection->total(),
        //         ],
        // ];
        return parent::toArray($request);
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'meta' => [
                'key' => 'value',
            ],
        ];
    }
}
