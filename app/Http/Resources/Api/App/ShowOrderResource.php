<?php

namespace App\Http\Resources\Api\App;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowOrderResource extends JsonResource
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
            "store_name" => $this->store_name,
            "store_address" => $this->store_address,
            "code" => $this->code,

            "total" => number_format($this->total, 0, '', '.'),
            "total_with_delivery" => number_format($this->total_with_delivery, 0, '', '.'),
            "total_delivery" => number_format($this->total_delivery, 0, '', '.'),

            "order_type" => $this->order_type,
            "order_date" => date('d/m/Y', strtotime($this->order_date)),
            "order_time" => $this->order_time,
            "state" => $this->state,

            "products" => ShowOrderProductsResource::collection($this->products)
        ];
    }
}
