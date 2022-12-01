<?php

namespace App\Http\Controllers\Api\Backoffice\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use App\UseCases\Api\Backoffice\Product\DeleteProductUseCase;
use Illuminate\Http\JsonResponse;

class DeleteProductController extends Controller
{
    public function __invoke(Store $store, Product $product): JsonResponse
    {
        (new DeleteProductUseCase())->__invoke($store, $product);
        return response()->json([], JsonResponse::HTTP_CREATED);
    }
}
