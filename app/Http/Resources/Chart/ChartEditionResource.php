<?php

namespace AvisoNavAPI\Http\Resources\Chart;

use Illuminate\Http\Resources\Json\JsonResource;

class ChartEditionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'edition'           => $this->edition,
            'year'              => $this->year,
            'createdAt'         =>  $this->created_at->format('Y-m-d'),
            'updatedAt'         =>  $this->updated_at->format('Y-m-d'),
            'chart'             => new ChartResource($this->chart),
            'links'             => [
                'self'  =>  route('chart.chartEdition.show', ['chartId' => $this->chart->id, 'id' => $this->id]),
                'chart' => route('chart.show', ['id' => $this->chart->id])
            ]
        ];
    }
}
