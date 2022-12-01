<?php

namespace App\UseCases\Api\Backoffice\Product;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\JsonResponse;

class ShowProductUseCase
{
    public function __invoke(Store $store, Product $product): Product
    {
        if ($product->store_id !== $store->id) {
            throw new \Exception('El producto no pertenece a esta tienda.', JsonResponse::HTTP_BAD_REQUEST);
        }

        return $product;
    }
}
