<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CategoryRespository
{
    public function get(Store $store): Collection
    {
        return $store->categories()->get();
    }

    public function paginate(Store $store): LengthAwarePaginator
    {
        return $store->categories()->paginate();
    }

    public function create(Store $store, array $data): Category
    {
        return $store->categories()->create($data);
    }

    public function update(Category $category, array $data): Category
    {
        $category->update($data);
        return $category;
    }

    public function delete(Category $category): bool
    {
        return $category->delete();
    }

    public function byId(Store $store, string $id): ?Category
    {
        return $store->categories()->where('id', $id)->first();
    }

    public function byName(Store $store, string $name): ?Category
    {
        return $store->categories()->where('name', $name)->first();
    }
}
