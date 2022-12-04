<?php

namespace App\UseCases\Api\Backoffice\ProductCategory;

use App\Models\Product;
use App\Repositories\ProductCategoryRepository;

class DeleteProductCategoriesUseCase
{
    private $repository;
    public function __construct()
    {
        $this->repository = new ProductCategoryRepository();
    }

    public function __invoke(Product $product): void
    {
        $this->repository->deleteByProduct($product);
    }
}
