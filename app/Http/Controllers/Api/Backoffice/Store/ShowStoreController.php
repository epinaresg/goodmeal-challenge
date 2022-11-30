<?php

namespace App\Http\Controllers\Api\Backoffice\Store;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Backoffice\Store\ShowStoreResource;
use App\Models\Store;
use Illuminate\Http\JsonResponse;

class ShowStoreController extends Controller
{
    public function __invoke(Store $store): JsonResponse
    {
        return response()->json(new ShowStoreResource($store), JsonResponse::HTTP_OK);
    }
}
