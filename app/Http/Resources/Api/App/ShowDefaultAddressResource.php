<?php

namespace App\Http\Resources\Api\App;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowDefaultAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "address" => $this->address,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
        ];
    }
}
