<?php

namespace App\UseCases\Api\Backoffice\Product;

use App\Models\Product;
use App\Models\Store;
use App\Repositories\ProductRespository;
use Illuminate\Http\JsonResponse;

class UpdateProductUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new ProductRespository();
    }

    public function __invoke(Store $store, Product $product, array $data): Product
    {
        if ($product->store_id !== $store->id) {
            throw new \Exception('El producto no pertenece a esta tienda.', JsonResponse::HTTP_BAD_REQUEST);
        }

        $productByName = $this->repository->byName($store, $data['name']);
        if ($productByName && $productByName->id !== $product->id) {
            throw new \Exception('El producto de esta tienda ya existe.', JsonResponse::HTTP_BAD_REQUEST);
        }

        return $this->repository->update($product, $data);
    }
}
