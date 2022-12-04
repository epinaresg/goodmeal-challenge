<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Resources\Api\App\ShowStoreProductsResource;
use App\Http\Resources\Api\App\ShowStoreResource;
use App\Models\Store;
use App\UseCases\Api\App\ListProductsGroupByCategory;
use Illuminate\Http\JsonResponse;

class ShowStoreController
{
    public function __invoke(Store $store): JsonResponse
    {
        $products = (new ListProductsGroupByCategory())->__invoke($store);

        return response()->json([
            'store' => new ShowStoreResource($store),
            'products' => ShowStoreProductsResource::collection($products)
        ], JsonResponse::HTTP_OK);
    }
}
