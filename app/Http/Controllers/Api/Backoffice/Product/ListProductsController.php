<?php

namespace App\Http\Controllers\Api\Backoffice\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Backoffice\Product\ListProductsPaginationCollection;
use App\Models\Store;
use App\UseCases\Api\Backoffice\Product\ListProductsUseCase;
use Illuminate\Http\JsonResponse;

class ListProductsController extends Controller
{
    public function __invoke(Store $store): JsonResponse
    {
        $items = (new ListProductsUseCase())->__invoke($store);

        return response()->json(new ListProductsPaginationCollection($items), JsonResponse::HTTP_OK);
    }
}
