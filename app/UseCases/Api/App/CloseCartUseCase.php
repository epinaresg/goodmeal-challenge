<?php

namespace App\UseCases\Api\App;

use App\Models\Store;
use App\Repositories\AddressRepository;
use App\Repositories\OrderRepository;
use App\Repositories\StoreRespository;
use Illuminate\Http\JsonResponse;

class CloseCartUseCase
{
    private $orderRepository;
    private $addressRepository;
    private $storeRepository;
    public function __construct()
    {
        $this->addressRepository = new AddressRepository();
        $this->storeRepository = new StoreRespository();
        $this->orderRepository = new OrderRepository();
    }

    public function __invoke(Store $store, array $data): void
    {
        $order = $this->orderRepository->byStoreAndOpen($store);

        $schedule = $this->storeRepository->schedulesByType($store, $data['type']);

        if (!$schedule) {
            throw new \Exception('El horario de la tienda no esta registrada.', JsonResponse::HTTP_BAD_REQUEST);
        }

        $closeData = [
            'store_name' => $store->name,
            'store_address' => $store->address,
            'code' => 'OC-' . time(),
            'order_type' => $data['type'],
            'order_date' => date('Y-m-d'),
            'order_time' => substr($schedule->start_hour, 0, 5) . ' - ' . substr($schedule->end_hour, 0, 5) . ' hrs',
            'open' => 0,
        ];

        if ($data['type'] === 'delivery') {
            $address = $this->addressRepository->getDefaultAddress();

            if (!$address) {
                throw new \Exception('No cuenta con una dirección registrada.', JsonResponse::HTTP_BAD_REQUEST);
            }

            $closeData['total'] = $order->total_with_delivery;
            $closeData['customer_address'] = $address->address;
            $closeData['state'] = 'Por entregar';
        } else {
            $closeData['total_delivery'] = 0;
            $closeData['total_with_delivery'] = 0;
            $closeData['state'] = 'Por recoger';
        }

        $this->orderRepository->update($order, $closeData);
    }
}
