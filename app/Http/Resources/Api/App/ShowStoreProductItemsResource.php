<?php

namespace App\Http\Resources\Api\App;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowStoreProductItemsResource extends JsonResource
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
            "image" => $this->image,

            "price_with_discount" => number_format($this->price_with_discount, 0, '', '.'),
            "price_without_discount" => number_format($this->price_without_discount, 0, '', '.'),
        ];
    }
}
