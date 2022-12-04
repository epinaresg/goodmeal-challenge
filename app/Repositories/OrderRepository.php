<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Store;

class OrderRepository
{
    public function create(array $data): Order
    {
        return Order::create($data);
    }

    public function update(Order $order, array $data): bool
    {
        return $order->update($data);
    }

    public function byStoreAndOpen(Store $store): ?Order
    {
        return Order::whereBelongsTo($store)->where('open', 1)->first();
    }
}
