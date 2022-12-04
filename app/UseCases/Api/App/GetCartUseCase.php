<?php

namespace App\UseCases\Api\App;

use App\Models\Order;
use App\Models\Store;
use App\Repositories\OrderRepository;

class GetCartUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new OrderRepository();
    }

    public function __invoke(Store $store): ?Order
    {
        $order = $this->repository->byStoreAndOpen($store);
        if (!$order) {
            $order = $this->repository->create([
                'store_id' => $store->id
            ]);

            $order = $order->fresh();
        }

        return $order;
    }
}
