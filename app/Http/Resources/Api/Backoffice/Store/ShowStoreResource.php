<?php

namespace App\Http\Resources\Api\Backoffice\Store;

use App\Http\Resources\Api\Backoffice\StoreSchedule\ListStoreSchedulesCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowStoreResource extends JsonResource
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
            "address" => $this->address,
            "slug" => $this->slug,
            "delivery" => $this->delivery,
            "take_out" => $this->take_out,
            "rating" => $this->rating,

            "schedules" => new ListStoreSchedulesCollection($this->schedules)
        ];
    }
}
