<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MonitoringResource extends JsonResource
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
            "amount" => $this->amount,
            "year" => $this->year,
            "status" => $this->status,
            "indicator" => $this->indicator,
            "indicator_id" => $this->indicator_id,
            "province" => $this->province,
            "province_id" => $this->province_id
        ];
    }
}
