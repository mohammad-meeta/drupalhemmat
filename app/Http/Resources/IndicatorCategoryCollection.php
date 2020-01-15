<?php

namespace App\Http\Resources;

use App\Http\Resources\IndicatorCategoryResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IndicatorCategoryCollection extends ResourceCollection
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
            'data' => IndicatorCategoryResource::Collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
