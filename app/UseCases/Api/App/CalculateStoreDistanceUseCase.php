<?php

namespace App\UseCases\Api\App;

use App\Models\Address;
use App\Repositories\AddressRepository;
use App\Repositories\StoreRespository;

class CalculateStoreDistanceUseCase
{
    private $storeRepository;
    private $addressRepository;
    public function __construct()
    {
        $this->storeRepository = new StoreRespository();
        $this->addressRepository = new AddressRepository();
    }

    public function __invoke(Address $address): void
    {
        $calculateStores = ($address->distances_store) ? json_decode($address->distances_store) : [];
        $calculateStoresData = ($address->distances_data) ? json_decode($address->distances_data) : [];

        $stores = $this->storeRepository->getWhereIdNotIn($calculateStores);

        foreach ($stores as $store) {
            $calculateStores[] = $store->id;

            $kmDistance = $this->getDistanceBetweenPointsNew(
                $store->latitude,
                $store->longitude,
                $address->latitude,
                $address->longitude,
            );

            $calculateStoresData[$store->id] = [
                'km' => number_format($kmDistance, 2, ',', ''),
                'walk' => ceil($kmDistance * 12)
            ];
        }

        $this->addressRepository->update($address, [
            'distances_store' => json_encode($calculateStores),
            'distances_data' => json_encode($calculateStoresData),
        ]);
    }

    private function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'miles')
    {
        $theta = $longitude1 - $longitude2;
        $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;
        switch($unit) {
            case 'miles':
                break;
            case 'kilometers':
                $distance = $distance * 1.609344;
        }
        return (round($distance, 2));
    }
}
