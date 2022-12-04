<?php

namespace App\UseCases\Api\App;

use App\Models\Store;
use App\Repositories\AddressRepository;

class SaveAddressUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new AddressRepository();
    }

    public function __invoke(array $data): void
    {
        $this->repository->removeDefault();

        $data['default'] = 1;
        $this->repository->create($data);
    }
}
