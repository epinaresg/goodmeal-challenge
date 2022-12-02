<?php

namespace App\UseCases\Api\Backoffice\Store;

use App\Models\Store;
use App\Repositories\StoreRespository;

class SetStorePricesUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new StoreRespository();
    }

    public function __invoke(Store $store): Store
    {
        $products = $store->products();

        $priceWithDiscount = $products->min('price_with_discount');
        $priceWithouDiscount = $products->min('price_without_discount');


        return $this->repository->update($store, [
            'price_with_discount' => $priceWithDiscount,
            'price_without_discount' => $priceWithouDiscount
        ]);
    }
}
