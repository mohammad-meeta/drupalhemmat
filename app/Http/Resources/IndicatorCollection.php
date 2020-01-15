<?php

namespace App\Http\Resources;

use App\Http\Resources\IndicatorResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IndicatorCollection extends ResourceCollection
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
            'data' => IndicatorResource::Collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
