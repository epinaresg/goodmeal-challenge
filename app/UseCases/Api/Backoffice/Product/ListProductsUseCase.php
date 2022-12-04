<?php

namespace App\UseCases\Api\Backoffice\Product;

use App\Models\Store;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListProductsUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new ProductRepository();
    }

    public function __invoke(Store $store): LengthAwarePaginator
    {
        return $this->repository->paginate($store);
    }
}
