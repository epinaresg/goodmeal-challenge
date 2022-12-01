<?php

namespace App\UseCases\Api\Backoffice\Category;

use App\Models\Category;
use App\Models\Store;
use App\Repositories\CategoryRespository;
use Illuminate\Http\JsonResponse;

class DeleteCategoryUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new CategoryRespository();
    }

    public function __invoke(Store $store, Category $category): void
    {
        if ($category->store_id !== $store->id) {
            throw new \Exception('La categoria no pertenece a esta tienda.', JsonResponse::HTTP_BAD_REQUEST);
        }

        $this->repository->delete($category);
    }
}
