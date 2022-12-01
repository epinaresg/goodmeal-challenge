<?php

namespace App\UseCases\Api\Backoffice\Product;

use App\Models\Product;
use App\Models\Store;
use App\Repositories\ProductRespository;
use Illuminate\Http\JsonResponse;

class CreateProductUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new ProductRespository();
    }

    public function __invoke(Store $store, array $data): Product
    {
        $product = $this->repository->byName($store, $data['name']);
        if ($product) {
            throw new \Exception('El producto de esta tienda ya existe.', JsonResponse::HTTP_BAD_REQUEST);
        }

        return $this->repository->create($store, $data);
    }
}
