<?php

namespace App\UseCases\Api\App;

use App\Models\Store;
use App\Repositories\StoreRespository;

class SetKindOfAttentionUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new StoreRespository();
    }

    public function __invoke(Store $store): void
    {
        $kindOfAttention = 'Retiro o delivery';
        if ($store->delivery == 1 && $store->take_out == 0) {
            $kindOfAttention = 'Delivery';
        } elseif ($store->delivery == 0 && $store->take_out == 1) {
            $kindOfAttention = 'Retiro';
        }

        $this->repository->update($store, [
            'kind_of_attention' => $kindOfAttention
        ]);
    }
}
