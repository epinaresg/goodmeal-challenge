<?php

namespace App\Http\Controllers\Api\Backoffice\Store;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\UseCases\DeleteStoreUseCase;
use Illuminate\Http\JsonResponse;

class DeleteStoreController extends Controller
{
    private $useCase;
    public function __construct(DeleteStoreUseCase $deleteStoreUseCase)
    {
        $this->useCase = $deleteStoreUseCase;
    }

    public function __invoke(Store $store): JsonResponse
    {
        try {
            $this->useCase->__invoke($store);
            return response()->json([], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
