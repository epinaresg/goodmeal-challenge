<?php

namespace App\Repositories;

use App\Models\Store;
use App\Models\StoreSchedule;

class StoreScheduleRespository
{
    public function create(Store $store, array $data): StoreSchedule
    {
        return $store->schedules()->create($data);
    }

    public function update(StoreSchedule $storeSchedule, array $data): bool
    {
        return $storeSchedule->update($data);
    }

    public function delete(StoreSchedule $storeSchedule): bool
    {
        return $storeSchedule->delete();
    }

    public function deleteByStoreAndType(Store $store, string $type): bool
    {
        return $store->schedules()->where('type', $type)->delete();
    }

    public function byId(string $id): ?StoreSchedule
    {
        return StoreSchedule::where('id', $id)->first();
    }
}
