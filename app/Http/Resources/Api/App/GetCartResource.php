<?php

namespace App\Http\Resources\Api\App;

use Illuminate\Http\Resources\Json\JsonResource;

class GetCartResource extends JsonResource
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
            "total" => number_format($this->total, 0, '', '.'),
            "total_delivery" => number_format($this->total_delivery, 0, '', '.'),
            "total_with_delivery" => number_format($this->total_with_delivery, 0, '', '.'),

            "qty_products" => $this->qty_products,

            "products" => GetCartProductsResource::collection($this->products)
        ];
    }
}
