<?php

namespace App\UseCases;

use App\Repositories\StoreRespository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListStoresUseCase
{
    private $repository;
    public function __construct(
        StoreRespository $storeRespository
    ) {
        $this->repository = $storeRespository;
    }

    public function __invoke(): LengthAwarePaginator
    {
        return $this->repository->get();
    }
}
