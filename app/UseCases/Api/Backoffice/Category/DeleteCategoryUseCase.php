<?php

namespace App\UseCases\Api\Backoffice\Category;

use App\Models\Category;
use App\Models\Store;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductCategoryRepository;
use Illuminate\Http\JsonResponse;

class DeleteCategoryUseCase
{
    private $categoryRepository;
    private $productCategoryRepository;
    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
        $this->productCategoryRepository = new ProductCategoryRepository();
    }

    public function __invoke(Store $store, Category $category): void
    {
        if ($category->store_id !== $store->id) {
            throw new \Exception('La categoria no pertenece a esta tienda.', JsonResponse::HTTP_BAD_REQUEST);
        }

        $this->categoryRepository->delete($category);
        $this->productCategoryRepository->deleteByCategory($category);
    }
}
