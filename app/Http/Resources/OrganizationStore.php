<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationStore extends JsonResource
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
            "title"   => $this->title,
            "city"   => [
                "id" => $this->city->id,
                "title" => $this->city->title,
            ],
        ];
        // return parent::toArray($request);
    }
}
