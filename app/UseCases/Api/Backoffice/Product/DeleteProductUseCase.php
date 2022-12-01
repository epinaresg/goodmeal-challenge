<?php

namespace App\UseCases\Api\Backoffice\Product;

use App\Models\Product;
use App\Models\Store;
use App\Repositories\ProductRespository;
use Illuminate\Http\JsonResponse;

class DeleteProductUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new ProductRespository();
    }

    public function __invoke(Store $store, Product $product): void
    {
        if ($product->store_id !== $store->id) {
            throw new \Exception('El producto no pertenece a esta tienda.', JsonResponse::HTTP_BAD_REQUEST);
        }

        $this->repository->delete($product);
    }
}
