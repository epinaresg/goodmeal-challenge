<?php

namespace App\Http\Resources\Api\Backoffice\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ListProductsPaginationResource extends JsonResource
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
            "price_with_discount" => $this->price_with_discount,
            "price_without_discount" => $this->price_without_discount,
        ];
    }
}
