<?php

namespace App\UseCases\Api\App;

use App\Repositories\OrderRepository;
use Illuminate\Database\Eloquent\Collection;

class ListOrdersUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new OrderRepository();
    }

    public function __invoke(): Collection
    {
        return $this->repository->getClosedOrders();
    }
}
