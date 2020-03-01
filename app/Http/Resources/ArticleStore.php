<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleStore extends JsonResource
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
            "id"   => $this->id,
            "title" => $this->title,
            "body" => $this->body,
            "department" => $this->department,
            "type" => $this->whenLoaded('type'),
            "status" => $this->status
        ];
        //    return parent::toArray($request);
    }
}
