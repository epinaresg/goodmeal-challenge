<?php

namespace App\Http\Controllers\Api\Backoffice\Store;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Backoffice\Store\ListStoresPaginationCollection;
use App\UseCases\ListStoresUseCase;
use Illuminate\Http\JsonResponse;

class ListStoresController extends Controller
{
    private $useCase;
    public function __construct(ListStoresUseCase $listStoresUseCase)
    {
        $this->useCase = $listStoresUseCase;
    }

    public function __invoke(): JsonResponse
    {
        $items = $this->useCase->__invoke();

        return response()->json(new ListStoresPaginationCollection($items), JsonResponse::HTTP_OK);
    }
}
