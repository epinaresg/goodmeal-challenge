<?php

namespace App\Http\Controllers\Api\Backoffice\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Backoffice\Product\CreateProductRequest;
use App\Models\Store;
use App\UseCases\Api\Backoffice\Product\CreateProductUseCase;
use App\UseCases\Api\Backoffice\ProductCategory\CreateProductCategoryUseCase;
use App\UseCases\Api\Backoffice\ProductCategory\DeleteProductCategoriesUseCase;
use Illuminate\Http\JsonResponse;

class CreateProductController extends Controller
{
    public function __invoke(Store $store, CreateProductRequest $request): JsonResponse
    {
        $dataValidated = $request->validated();
        $product = (new CreateProductUseCase())->__invoke($store, $dataValidated);

        if (isset($dataValidated['product_categories']) && !empty($dataValidated['product_categories'])) {
            foreach ($dataValidated['product_categories'] as $data) {
                (new CreateProductCategoryUseCase())->__invoke($product, $data);
            }
        } else {
            (new DeleteProductCategoriesUseCase())->__invoke($product);
        }

        return response()->json([], JsonResponse::HTTP_CREATED);
    }
}
