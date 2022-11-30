<?php

namespace App\Http\Controllers\Api\Backoffice\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Backoffice\Store\UpdateStoreRequest;
use App\Models\Store;
use App\UseCases\UpdateStoreUseCase;
use Illuminate\Http\JsonResponse;

class UpdateStoreController extends Controller
{
    private $useCase;
    public function __construct(UpdateStoreUseCase $updateStoreUseCase)
    {
        $this->useCase = $updateStoreUseCase;
    }

    public function __invoke(Store $store, UpdateStoreRequest $request): JsonResponse
    {
        try {
            $this->useCase->__invoke($store, $request->validated());
            return response()->json([], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
