<?php

namespace App\UseCases\Api\App;

use App\Models\Store;
use App\Repositories\OrderProductRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;

class AddProductToCart
{
    private $orderRepository;
    private $orderProductRepository;
    private $productRepository;
    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->orderProductRepository = new OrderProductRepository();
        $this->productRepository = new ProductRepository();
    }

    public function __invoke(Store $store, array $data): void
    {
        $product = $this->productRepository->byId($store, $data['product_id']);
        if (!$product) {
            throw new \Exception('El producto no existe.', JsonResponse::HTTP_BAD_REQUEST);
        }

        $order = $this->orderRepository->byStoreAndOpen($store);

        $orderProduct = $this->orderProductRepository->byProduct($order, $product);
        if (!$orderProduct) {
            $this->orderProductRepository->create($order, [
                'store_id' => $store->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'qty' => 1,
                'total' => $product->price_with_discount
            ]);
        } else {
            $qty = $orderProduct->qty + 1;
            $this->orderProductRepository->update($orderProduct, [
                'product_name' => $product->name,
                'qty' => $qty,
                'total' => $product->price_with_discount * $qty
            ]);
        }

        $total = $order->order_products->sum('total');
        $this->orderRepository->update($order, [
            'qty_products' => $order->order_products->sum('qty'),
            'total' => $total,
            'total_with_delivery' => $total + $order->total_delivery
        ]);
    }
}
