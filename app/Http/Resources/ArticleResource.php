<?php

namespace App\Http\Resources;

use App\Http\Resources\FileCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            "id" => $this->id,
            "title" => $this->title,
            "body" => $this->body,
            "status" => $this->status,
            "type" => $this->type,
            "type_id" => $this->type_id,
            "document_category" => $this->document_category,
            "document_category_id" => $this->document_category_id,
            "files" => new FileCollection($this->files)
        ];
    }
}
