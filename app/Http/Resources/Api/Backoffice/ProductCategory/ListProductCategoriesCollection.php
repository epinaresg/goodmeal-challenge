<?php

namespace App\Http\Resources\Api\Backoffice\ProductCategory;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ListProductCategoriesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ListProductCategoriesResource::collection($this->collection);
    }
}
