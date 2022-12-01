<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductCategory;

class ProductCategoryRespository
{
    public function create(Product $product, array $data): ProductCategory
    {
        return $product->product_categories()->create($data);
    }

    public function update(ProductCategory $productCategory, array $data): bool
    {
        return $productCategory->update($data);
    }

    public function delete(ProductCategory $productCategory): bool
    {
        return $productCategory->delete();
    }

    public function deleteByProduct(Product $product): bool
    {
        return $product->product_categories()->delete();
    }

    public function byId(string $id): ?ProductCategory
    {
        return ProductCategory::where('id', $id)->first();
    }
}
