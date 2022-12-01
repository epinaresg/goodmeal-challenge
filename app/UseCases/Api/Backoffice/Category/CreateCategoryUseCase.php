<?php

namespace App\UseCases\Api\Backoffice\Category;

use App\Models\Category;
use App\Models\Store;
use App\Repositories\CategoryRespository;
use Illuminate\Http\JsonResponse;

class CreateCategoryUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new CategoryRespository();
    }

    public function __invoke(Store $store, array $data): Category
    {
        $category = $this->repository->byName($store, $data['name']);
        if ($category) {
            throw new \Exception('La categoria de esta tienda ya existe.', JsonResponse::HTTP_BAD_REQUEST);
        }

        return $this->repository->create($store, $data);
    }
}
