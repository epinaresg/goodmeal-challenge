<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductCategoryRepository
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

    public function deleteByCategory(Category $category): bool
    {
        return ProductCategory::whereBelongsTo($category)->delete();
    }

    public function byId(string $id): ?ProductCategory
    {
        return ProductCategory::where('id', $id)->first();
    }
}
