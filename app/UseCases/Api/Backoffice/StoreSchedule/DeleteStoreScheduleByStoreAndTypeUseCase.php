<?php

namespace App\UseCases\Api\Backoffice\StoreSchedule;

use App\Models\Store;
use App\Repositories\StoreScheduleRepository;

class DeleteStoreScheduleByStoreAndTypeUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new StoreScheduleRepository();
    }

    public function __invoke(Store $store, $type): void
    {
        $this->repository->deleteByStoreAndType($store, $type);
    }
}
