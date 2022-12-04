<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Requests\Api\App\CloseCartRequest;
use App\Models\Store;
use App\UseCases\Api\App\CloseCartUseCase;
use Illuminate\Http\JsonResponse;

class CloseCartController
{
    public function __invoke(CloseCartRequest $request, Store $store): JsonResponse
    {
        (new CloseCartUseCase())->__invoke($store, $request->validated());
        return response()->json([], JsonResponse::HTTP_CREATED);
    }
}
