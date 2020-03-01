<?php

namespace App\Http\Resources;

use App\Http\Resources\DepartmentResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DepartmentCollection extends ResourceCollection
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
            'data' => DepartmentResource::Collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
