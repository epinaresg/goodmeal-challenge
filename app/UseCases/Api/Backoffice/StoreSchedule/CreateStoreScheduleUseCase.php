<?php

namespace App\UseCases\Api\Backoffice\StoreSchedule;

use App\Models\Store;
use App\Repositories\StoreScheduleRespository;
use Illuminate\Http\JsonResponse;

class CreateStoreScheduleUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new StoreScheduleRespository();
    }

    public function __invoke(Store $store, $type, array $data): void
    {
        $data['type'] = $type;

        if (isset($data['id']) && $data['id'] != '') {
            $storeSchedule = $this->repository->byId($data['id']);
            if (!$storeSchedule) {
                throw new \Exception('Id del horario no válido.', JsonResponse::HTTP_BAD_REQUEST);
            }

            $this->repository->update($storeSchedule, $data);
        } else {
            $this->repository->deleteByStoreAndType($store, $type);
            $this->repository->create($store, $data);
        }
    }
}
