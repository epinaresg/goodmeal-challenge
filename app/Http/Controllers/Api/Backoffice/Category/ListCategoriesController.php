<?php

namespace App\Http\Controllers\Api\Backoffice\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Backoffice\Category\ListCategoriesPaginationCollection;
use App\Models\Store;
use App\UseCases\Api\Backoffice\Category\ListCategoriesUseCase;
use Illuminate\Http\JsonResponse;

class ListCategoriesController extends Controller
{
    public function __invoke(Store $store): JsonResponse
    {
        $items = (new ListCategoriesUseCase())->__invoke($store);

        return response()->json(new ListCategoriesPaginationCollection($items), JsonResponse::HTTP_OK);
    }
}
