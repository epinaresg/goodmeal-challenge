<?php

namespace App\Http\Controllers\Api\Backoffice\Store;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Backoffice\Store\ListStoresPaginationCollection;
use App\UseCases\Api\Backoffice\Store\ListStoresUseCase;
use Illuminate\Http\JsonResponse;

class ListStoresController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $items = (new ListStoresUseCase())->__invoke();

        return response()->json(new ListStoresPaginationCollection($items), JsonResponse::HTTP_OK);
    }
}
