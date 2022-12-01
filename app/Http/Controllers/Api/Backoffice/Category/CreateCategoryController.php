<?php

namespace App\Http\Controllers\Api\Backoffice\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Backoffice\Category\CreateCategoryRequest;
use App\Models\Store;
use App\UseCases\Api\Backoffice\Category\CreateCategoryUseCase;
use Illuminate\Http\JsonResponse;

class CreateCategoryController extends Controller
{
    public function __invoke(Store $store, CreateCategoryRequest $request): JsonResponse
    {
        $dataValidated = $request->validated();
        (new CreateCategoryUseCase())->__invoke($store, $dataValidated);

        return response()->json([], JsonResponse::HTTP_CREATED);
    }
}
