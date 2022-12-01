<?php

namespace App\UseCases\Api\Backoffice\ProductCategory;

use App\Models\Product;
use App\Repositories\ProductCategoryRespository;

class DeleteProductCategoriesUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new ProductCategoryRespository();
    }

    public function __invoke(Product $product): void
    {
        $this->repository->deleteByProduct($product);
    }
}
