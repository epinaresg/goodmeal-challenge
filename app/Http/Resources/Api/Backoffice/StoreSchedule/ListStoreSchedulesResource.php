<?php

namespace App\Http\Resources\Api\Backoffice\StoreSchedule;

use Illuminate\Http\Resources\Json\JsonResource;

class ListStoreSchedulesResource extends JsonResource
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
            "type" => $this->type,
            "start_hour" => $this->start_hour,
            "end_hour" => $this->end_hour,
        ];
    }
}
