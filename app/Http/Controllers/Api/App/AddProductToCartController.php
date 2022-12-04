<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Requests\Api\App\AddProductToCartRequest;
use App\Models\Store;
use App\UseCases\Api\App\AddProductToCart;
use Illuminate\Http\JsonResponse;

class AddProductToCartController
{
    public function __invoke(AddProductToCartRequest $request, Store $store): JsonResponse
    {
        (new AddProductToCart())->__invoke($store, $request->validated());

        return response()->json([], JsonResponse::HTTP_CREATED);
    }
}
