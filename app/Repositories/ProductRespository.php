<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRespository
{
    public function get(Store $store): LengthAwarePaginator
    {
        return $store->products()->paginate();
    }

    public function create(Store $store, array $data): Product
    {
        return $store->products()->create($data);
    }

    public function update(Product $product, array $data): Product
    {
        $product->update($data);
        return $product;
    }

    public function delete(Product $product): bool
    {
        return $product->delete();
    }

    public function byId(Store $store, string $id): ?Product
    {
        return $store->products()->where('id', $id)->first();
    }

    public function byName(Store $store, string $name): ?Product
    {
        return $store->products()->where('name', $name)->first();
    }
}
