<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\App\ListStoresGroupByStockResource;
use App\UseCases\Api\App\ListStoresGroupByStockUseCase;
use Illuminate\Http\JsonResponse;

class ListStoresGroupByStockController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $addressId = request()->address_id;

        $items = (new ListStoresGroupByStockUseCase())->__invoke($addressId);

        return response()->json([
            'with_stock' => ListStoresGroupByStockResource::collection($items['with_stock']),
            'without_stock' => ListStoresGroupByStockResource::collection($items['without_stock'])
        ], JsonResponse::HTTP_OK);
    }
}
