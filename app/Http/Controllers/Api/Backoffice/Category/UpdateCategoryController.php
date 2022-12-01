<?php

namespace App\Http\Controllers\Api\Backoffice\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Backoffice\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Store;
use App\UseCases\Api\Backoffice\Category\UpdateCategoryUseCase;
use Illuminate\Http\JsonResponse;

class UpdateCategoryController extends Controller
{
    public function __invoke(Store $store, Category $category, UpdateCategoryRequest $request): JsonResponse
    {
        $dataValidated = $request->validated();
        (new UpdateCategoryUseCase())->__invoke($store, $category, $dataValidated);

        return response()->json([], JsonResponse::HTTP_CREATED);
    }
}
