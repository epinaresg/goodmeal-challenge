<?php

namespace App\Http\Resources\Api\Backoffice\Product;

use App\Http\Resources\Api\Backoffice\ProductCategory\ListProductCategoriesCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowProductResource extends JsonResource
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

            "product_categories" => new ListProductCategoriesCollection($this->product_categories)
        ];
    }
}
