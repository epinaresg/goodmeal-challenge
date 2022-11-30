<?php

namespace App\Http\Controllers\Api\Backoffice\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Backoffice\Store\UpdateStoreRequest;
use App\Models\Store;
use App\UseCases\Api\Backoffice\Store\UpdateStoreUseCase;
use App\UseCases\Api\Backoffice\StoreSchedule\CreateStoreScheduleUseCase;
use App\UseCases\Api\Backoffice\StoreSchedule\DeleteStoreScheduleByStoreAndTypeUseCase;
use Illuminate\Http\JsonResponse;

class UpdateStoreController extends Controller
{
    public function __invoke(Store $store, UpdateStoreRequest $request): JsonResponse
    {
        try {
            $dataValidated = $request->validated();
            $store = (new UpdateStoreUseCase())->__invoke($store, $dataValidated);

            if (isset($dataValidated['schedules']['take_out'])) {
                (new CreateStoreScheduleUseCase())->__invoke($store, 'take_out', $dataValidated['schedules']['take_out']);
            } else {
                (new DeleteStoreScheduleByStoreAndTypeUseCase())->__invoke($store, 'take_out');
            }

            if (isset($dataValidated['schedules']['delivery'])) {
                (new CreateStoreScheduleUseCase())->__invoke($store, 'delivery', $dataValidated['schedules']['delivery']);
            } else {
                (new DeleteStoreScheduleByStoreAndTypeUseCase())->__invoke($store, 'delivery');
            }

            return response()->json([], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], ($e->getCode() === '0') ? $e->getCode() : 500);
        }
    }
}
