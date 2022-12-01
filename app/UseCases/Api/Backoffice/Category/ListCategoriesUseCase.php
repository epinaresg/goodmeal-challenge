<?php

namespace App\UseCases\Api\Backoffice\Category;

use App\Models\Store;
use App\Repositories\CategoryRespository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListCategoriesUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new CategoryRespository();
    }

    public function __invoke(Store $store): LengthAwarePaginator
    {
        return $this->repository->get($store);
    }
}
