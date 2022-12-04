<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\App\ShowOrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class ShowOrderController extends Controller
{
    public function __invoke(Order $order): JsonResponse
    {
        return response()->json(new ShowOrderResource($order), JsonResponse::HTTP_OK);
    }
}
