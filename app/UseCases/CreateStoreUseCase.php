<?php

namespace App\UseCases;

use App\Repositories\StoreRespository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class CreateStoreUseCase
{
    private $repository;
    public function __construct(
        StoreRespository $storeRespository
    ) {
        $this->repository = $storeRespository;
    }

    public function __invoke(array $data): void
    {
        $store = $this->repository->byName($data['name']);

        if ($store) {
            throw new \Exception('La tienda a registra ya existe.', JsonResponse::HTTP_BAD_REQUEST);
        }

        $data['slug'] = Str::slug($data['name']);

        $this->repository->create($data);
    }
}
