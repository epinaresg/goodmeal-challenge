<?php

namespace App\Http\Controllers\Api\Backoffice\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Store;
use App\UseCases\Api\Backoffice\Category\DeleteCategoryUseCase;
use Illuminate\Http\JsonResponse;

class DeleteCategoryController extends Controller
{
    public function __invoke(Store $store, Category $category): JsonResponse
    {
        try {
            (new DeleteCategoryUseCase())->__invoke($store, $category);
            return response()->json([], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], ($e->getCode() == '0') ? 500 : $e->getCode());
        }
    }
}
