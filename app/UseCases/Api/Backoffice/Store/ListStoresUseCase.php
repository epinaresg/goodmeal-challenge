<?php

namespace App\UseCases\Api\Backoffice\Store;

use App\Repositories\StoreRespository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListStoresUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new StoreRespository();
    }

    public function __invoke(): LengthAwarePaginator
    {
        return $this->repository->get();
    }
}
