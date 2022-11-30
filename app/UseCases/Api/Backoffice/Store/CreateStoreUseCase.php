<?php

namespace App\UseCases\Api\Backoffice\Store;

use App\Models\Store;
use App\Repositories\StoreRespository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class CreateStoreUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new StoreRespository();
    }

    public function __invoke(array $data): Store
    {
        $store = $this->repository->byName($data['name']);

        if ($store) {
            throw new \Exception('La tienda a registra ya existe.', JsonResponse::HTTP_BAD_REQUEST);
        }

        $data['slug'] = Str::slug($data['name']);

        return $this->repository->create($data);
    }
}
