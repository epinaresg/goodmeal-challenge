<?php

namespace App\Http\Resources\Api\Backoffice\Product;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ListProductsPaginationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'items' => ListProductsPaginationResource::collection($this->collection),
            'pagination' => [
                "current_page" => $this->currentPage(),
                "prev_page_url" =>  $this->previousPageUrl(),
                "next_page_url" =>  $this->nextPageUrl(),
                "last_page" =>  $this->lastPage(),
                "per_page" =>  $this->perPage(),
                "total" =>  $this->total(),
            ],
        ];
    }
}
