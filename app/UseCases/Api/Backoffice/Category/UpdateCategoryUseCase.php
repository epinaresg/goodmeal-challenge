<?php

namespace App\UseCases\Api\Backoffice\Category;

use App\Models\Category;
use App\Models\Store;
use App\Repositories\CategoryRespository;
use Illuminate\Http\JsonResponse;

class UpdateCategoryUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new CategoryRespository();
    }

    public function __invoke(Store $store, Category $category, array $data): Category
    {
        if ($category->store_id !== $store->id) {
            throw new \Exception('La categoria no pertenece a esta tienda.', JsonResponse::HTTP_BAD_REQUEST);
        }

        $categoryByName = $this->repository->byName($store, $data['name']);
        if ($categoryByName && $categoryByName->id !== $category->id) {
            throw new \Exception('La categoria de esta tienda ya existe.', JsonResponse::HTTP_BAD_REQUEST);
        }

        return $this->repository->update($category, $data);
    }
}
