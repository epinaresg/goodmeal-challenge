<?php

namespace App\UseCases\Api\Backoffice\Category;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\JsonResponse;

class ShowCategoryUseCase
{
    public function __invoke(Store $store, Category $category): Category
    {
        if ($category->store_id !== $store->id) {
            throw new \Exception('La categoria no pertenece a esta tienda.', JsonResponse::HTTP_BAD_REQUEST);
        }

        return $category;
    }
}
