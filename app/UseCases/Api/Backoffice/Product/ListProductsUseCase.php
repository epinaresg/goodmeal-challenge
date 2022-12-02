<?php

namespace App\UseCases\Api\Backoffice\Product;

use App\Models\Store;
use App\Repositories\ProductRespository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListProductsUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new ProductRespository();
    }

    public function __invoke(Store $store): LengthAwarePaginator
    {
        return $this->repository->paginate($store);
    }
}
