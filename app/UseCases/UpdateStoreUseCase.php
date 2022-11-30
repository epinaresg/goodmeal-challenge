<?php

namespace App\UseCases;

use App\Models\Store;
use App\Repositories\StoreRespository;
use Illuminate\Support\Str;

class UpdateStoreUseCase
{
    private $repository;
    public function __construct(
        StoreRespository $storeRespository
    ) {
        $this->repository = $storeRespository;
    }

    public function __invoke(Store $store, array $data): void
    {
        $data['slug'] = Str::slug($data['name']);

        $this->repository->update($store, $data);
    }
}
