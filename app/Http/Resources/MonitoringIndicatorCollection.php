<?php

namespace App\Http\Resources;

use App\Http\Resources\MonitoringIndicatorResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MonitoringIndicatorCollection extends ResourceCollection
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
            'data' => MonitoringIndicatorResource::Collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
