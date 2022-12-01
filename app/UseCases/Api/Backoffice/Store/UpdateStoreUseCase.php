<?php

namespace App\UseCases\Api\Backoffice\Store;

use App\Models\Store;
use App\Repositories\StoreRespository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class UpdateStoreUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new StoreRespository();
    }

    public function __invoke(Store $store, array $data): Store
    {
        $storeByName = $this->repository->byName($data['name']);
        if ($storeByName && $storeByName->id !== $store->id) {
            throw new \Exception('El nombre de esta tienda ya existe.', JsonResponse::HTTP_BAD_REQUEST);
        }

        $data['slug'] = Str::slug($data['name']);

        return $this->repository->update($store, $data);
    }
}
