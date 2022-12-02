<?php

namespace App\UseCases\Api\App;

use App\Repositories\StoreRespository;

class ListStoresGroupByStockUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new StoreRespository();
    }

    public function __invoke(): array
    {
        $stores = $this->repository->get();

        $storesArr = [
            'with_stock' => $stores->where('products_with_stock', '>', 0),
            'without_stock' => $stores->where('products_with_stock', 0)
        ];

        return $storesArr;
    }
}
