<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;

class OrderProductRepository
{
    public function create(Order $order, array $data): OrderProduct
    {
        return $order->order_products()->create($data);
    }

    public function update(OrderProduct $orderProduct, array $data): bool
    {
        return $orderProduct->update($data);
    }

    public function byProduct(Order $order, Product $product): ?OrderProduct
    {
        return OrderProduct::where([
            ['order_id', '=', $order->id],
            ['product_id', '=', $product->id]
        ])->first();
    }
}
