<?php

namespace App\Http\Controllers\Api\Backoffice\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Backoffice\Category\ShowCategoryResource;
use App\Models\Category;
use App\Models\Store;
use App\UseCases\Api\Backoffice\Category\ShowCategoryUseCase;
use Illuminate\Http\JsonResponse;

class ShowCategoryController extends Controller
{
    public function __invoke(Store $store, Category $category): JsonResponse
    {
        $category = (new ShowCategoryUseCase())->__invoke($store, $category);

        return response()->json(new ShowCategoryResource($category), JsonResponse::HTTP_OK);
    }
}
