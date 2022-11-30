<?php

namespace App\UseCases;

use App\Models\Store;
use App\Repositories\StoreRespository;
use Illuminate\Support\Str;

class DeleteStoreUseCase
{
    private $repository;
    public function __construct(
        StoreRespository $storeRespository
    ) {
        $this->repository = $storeRespository;
    }

    public function __invoke(Store $store): void
    {
        $this->repository->delete($store);
    }
}
