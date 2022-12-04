<?php

namespace App\UseCases\Api\Backoffice\ProductCategory;

use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductCategoryRepository;
use Illuminate\Http\JsonResponse;

class CreateProductCategoryUseCase
{
    private $productCategoryRepository;
    private $categoryRepository;
    public function __construct()
    {
        $this->productCategoryRepository = new ProductCategoryRepository();
        $this->categoryRepository = new CategoryRepository();
    }

    public function __invoke(Product $product, array $data): void
    {
        $category = $this->categoryRepository->byId($product->store, $data['category_id']);
        if (!$category) {
            throw new \Exception('Id de la categoria no existe.', JsonResponse::HTTP_BAD_REQUEST);
        }

        $data['store_id'] = $product->store_id;

        if (isset($data['id']) && $data['id'] != '') {
            $productCategory = $this->productCategoryRepository->byId($data['id']);
            if (!$productCategory) {
                throw new \Exception('Id de la categoria ha actualizar no válido.', JsonResponse::HTTP_BAD_REQUEST);
            }

            $this->productCategoryRepository->update($productCategory, $data);
        } else {
            $this->productCategoryRepository->create($product, $data);
        }
    }
}
