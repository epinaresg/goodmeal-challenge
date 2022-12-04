<?php

namespace App\UseCases\Api\App;

use App\Repositories\AddressRepository;
use App\Repositories\StoreRespository;

class ListStoresGroupByStockUseCase
{
    private $storeRepository;
    private $addressRespository;
    public function __construct()
    {
        $this->storeRepository = new StoreRespository();
        $this->addressRespository = new AddressRepository();
    }

    public function __invoke(?string $addressId): array
    {
        $stores = $this->storeRepository->get();

        if ($addressId) {
            $address = $this->addressRespository->byId($addressId);

            if ($address) {
                $distanceData = ($address->distances_data) ? json_decode($address->distances_data, true) : [];

                foreach ($stores as $k => $store) {
                    $stores[$k]->distance_km = '';
                    $stores[$k]->distance_walk = '';
                    if (isset($distanceData[$store->id])) {
                        $stores[$k]->distance_km = $distanceData[$store->id]['km'] . ' km';
                        $stores[$k]->distance_walk = $distanceData[$store->id]['walk'] . ' min';
                    }
                }
            }
        }

        $storesArr = [
            'with_stock' => $stores->where('products_with_stock', '>', 0),
            'without_stock' => $stores->where('products_with_stock', 0)
        ];

        return $storesArr;
    }
}
