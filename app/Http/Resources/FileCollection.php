<?php

namespace App\Http\Resources;

use App\Http\Resources\FileResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FileCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return FileResource::collection($this->collection);
    }
}
