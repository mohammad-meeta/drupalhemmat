<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class IndicatorMonitoringCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => IndicatorMonitoringResource::collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
