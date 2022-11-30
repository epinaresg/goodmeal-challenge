<?php

namespace App\UseCases\Api\Backoffice\Store;

use App\Models\Store;
use App\Repositories\StoreRespository;

class DeleteStoreUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new StoreRespository();
    }

    public function __invoke(Store $store): void
    {
        $this->repository->delete($store);
    }
}
