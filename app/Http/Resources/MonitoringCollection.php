<?php

namespace App\Http\Resources;

use App\Http\Resources\MonitoringResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MonitoringCollection extends ResourceCollection
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
            'data' => MonitoringResource::Collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
