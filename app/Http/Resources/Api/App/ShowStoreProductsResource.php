<?php

namespace App\Http\Resources\Api\App;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowStoreProductsResource extends JsonResource
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
            "category_id" => $this['category_id'],
            "category_name" => $this['category_name'],
            "items" => ShowStoreProductItemsResource::collection($this['products'])
        ];
    }
}
