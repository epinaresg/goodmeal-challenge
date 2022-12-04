<?php

namespace App\Http\Resources\Api\App;

use Illuminate\Http\Resources\Json\JsonResource;

class ListStoresGroupByStockResource extends JsonResource
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
            "opening_hours" => $this->opening_hours,
            "kind_of_attention" => $this->kind_of_attention,

            "delivery" => $this->delivery,
            "take_out" => $this->take_out,

            "price_with_discount" => number_format($this->price_with_discount, 0, '', '.'),
            "price_without_discount" => number_format($this->price_without_discount, 0, '', '.'),

            "products_with_stock" => $this->products_with_stock,

            "distance_km" => $this->distance_km,
            "distance_walk" => $this->distance_walk,
        ];
    }
}
