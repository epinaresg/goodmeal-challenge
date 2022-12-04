<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\App\ListOrdersResource;
use App\UseCases\Api\App\ListOrdersUseCase;
use Illuminate\Http\JsonResponse;

class ListOrdersController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $orders = (new ListOrdersUseCase())->__invoke();
        return response()->json(ListOrdersResource::collection($orders), JsonResponse::HTTP_OK);
    }
}
