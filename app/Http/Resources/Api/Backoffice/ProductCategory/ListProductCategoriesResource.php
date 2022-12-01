<?php

namespace App\Http\Resources\Api\Backoffice\ProductCategory;

use Illuminate\Http\Resources\Json\JsonResource;

class ListProductCategoriesResource extends JsonResource
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
            "category_id" => $this->category_id,
        ];
    }
}
