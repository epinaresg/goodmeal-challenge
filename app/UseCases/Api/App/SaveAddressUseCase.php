<?php

namespace App\UseCases\Api\App;

use App\Repositories\AddressRespository;

class SaveAddressUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new AddressRespository();
    }

    public function __invoke(array $data): void
    {
        $this->repository->removeDefault();

        $data['default'] = 1;
        $this->repository->create($data);
    }
}
