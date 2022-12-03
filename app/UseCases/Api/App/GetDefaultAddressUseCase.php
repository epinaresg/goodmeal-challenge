<?php

namespace App\UseCases\Api\App;

use App\Models\Address;
use App\Repositories\AddressRespository;

class GetDefaultAddressUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new AddressRespository();
    }

    public function __invoke(): ?Address
    {
        return $this->repository->getDefaultAddress();
    }
}
