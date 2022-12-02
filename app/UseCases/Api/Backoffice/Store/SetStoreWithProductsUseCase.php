<?php

namespace App\UseCases\Api\Backoffice\Store;

use App\Models\Store;
use App\Repositories\StoreRespository;

class SetStoreWithProductsUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new StoreRespository();
    }

    public function __invoke(Store $store): Store
    {
        $productsWithStock = $store->products()->where('stock', '>', 0)->count();
        return $this->repository->update($store, [
            'products_with_stock' => $productsWithStock
        ]);
    }
}
