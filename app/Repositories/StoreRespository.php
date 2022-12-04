<?php

namespace App\Repositories;

use App\Models\Store;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class StoreRespository
{
    public function get(): Collection
    {
        return Store::all();
    }

    public function getWhereIdNotIn(array $ids): Collection
    {
        return Store::whereNotIn('id', $ids)->get();
    }

    public function paginate(): LengthAwarePaginator
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
