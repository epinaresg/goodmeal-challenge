<?php

namespace App\Http\Resources\Api\Backoffice\StoreSchedule;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ListStoreSchedulesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ListStoreSchedulesResource::collection($this->collection);
    }
}
