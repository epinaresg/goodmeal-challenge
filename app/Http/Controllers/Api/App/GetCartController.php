<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Resources\Api\App\GetCartResource;
use App\Models\Store;
use App\UseCases\Api\App\GetCartUseCase;
use Illuminate\Http\JsonResponse;

class GetCartController
{
    public function __invoke(Store $store): JsonResponse
    {
        $order = (new GetCartUseCase())->__invoke($store);
        return response()->json(new GetCartResource($order), JsonResponse::HTTP_OK);
    }
}
