<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Store;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository
{
    public function getOpenOrders(): Collection
    {
        return Order::where('open', 1)->get();
    }
    public function getClosedOrders(): Collection
    {
        return Order::where('open', 0)->get();
    }

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
