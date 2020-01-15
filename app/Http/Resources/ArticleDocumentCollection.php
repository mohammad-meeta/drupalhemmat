<?php

namespace App\Http\Resources;

use App\Http\Resources\ArticleDocumentResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleDocumentCollection extends ResourceCollection
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
            'data' => ArticleDocumentResource::collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
