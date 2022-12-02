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

            "delivery" => $this->delivery,
            "take_out" => $this->take_out,

            "price_with_discount" => $this->price_with_discount,
            "price_without_discount" => $this->price_without_discount,

            "products_with_stock" => $this->products_with_stock,
        ];
    }
}
