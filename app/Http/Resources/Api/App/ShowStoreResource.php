<?php

namespace App\Http\Resources\Api\App;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowStoreResource extends JsonResource
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

            "id" => $this->id,
            "name" => $this->name,

            "logo" => $this->logo,
            "background" => $this->background,

            "address" => $this->address,
            "slug" => $this->slug,
            "delivery" => $this->delivery,
            "take_out" => $this->take_out,
            "rating" => $this->rating,

            "products_with_stock" => $this->products_with_stock,

            "schedules" => ShowStoreSchedulesResource::collection($this->schedules)
        ];
    }
}
