<?php

namespace App\Http\Controllers\Api\Backoffice\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Backoffice\Product\ShowProductResource;
use App\Models\Product;
use App\Models\Store;
use App\UseCases\Api\Backoffice\Product\ShowProductUseCase;
use Illuminate\Http\JsonResponse;

class ShowProductController extends Controller
{
    public function __invoke(Store $store, Product $product): JsonResponse
    {
        $product = (new ShowProductUseCase())->__invoke($store, $product);

        return response()->json(new ShowProductResource($product), JsonResponse::HTTP_OK);
    }
}
