<?php

namespace App\Repositories;

use App\Models\Store;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class StoreRespository
{
    public function get(): LengthAwarePaginator
    {
        return Store::paginate();
    }

    public function create(array $data): Store
    {
        return Store::create($data);
    }

    public function update(Store $store, array $data): Store
    {
        $store->update($data);
        return $store;
    }

    public function delete(Store $store): bool
    {
        return $store->delete();
    }

    public function byId(string $id): ?Store
    {
        return Store::where('id', $id)->first();
    }

    public function byName(string $name): ?Store
    {
        return Store::where('name', $name)->first();
    }
}
