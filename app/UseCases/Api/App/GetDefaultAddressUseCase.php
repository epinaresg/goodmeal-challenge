<?php

namespace App\UseCases\Api\App;

use App\Models\Address;
use App\Repositories\AddressRepository;

class GetDefaultAddressUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new AddressRepository();
    }

    public function __invoke(): ?Address
    {
        return $this->repository->getDefaultAddress();
    }
}
