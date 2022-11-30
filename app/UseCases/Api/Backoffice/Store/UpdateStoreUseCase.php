<?php

namespace App\UseCases\Api\Backoffice\Store;

use App\Models\Store;
use App\Repositories\StoreRespository;
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
        $data['slug'] = Str::slug($data['name']);

        return $this->repository->update($store, $data);
    }
}
