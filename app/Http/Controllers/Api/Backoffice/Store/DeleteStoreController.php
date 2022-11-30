<?php

namespace App\Http\Controllers\Api\Backoffice\Store;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\UseCases\Api\Backoffice\Store\DeleteStoreUseCase;
use Illuminate\Http\JsonResponse;

class DeleteStoreController extends Controller
{
    public function __invoke(Store $store): JsonResponse
    {
        try {
            (new DeleteStoreUseCase())->__invoke($store);
            return response()->json([], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
