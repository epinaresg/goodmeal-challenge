<?php

namespace App\UseCases\Api\App;

use App\Models\Store;
use App\Repositories\CategoryRespository;
use App\Repositories\ProductRespository;

class ListProductsGroupByCategory
{
    private $productRepository;
    private $categoryRepository;
    public function __construct()
    {
        $this->productRepository = new ProductRespository();
        $this->categoryRepository = new CategoryRespository();
    }

    public function __invoke(Store $store): array
    {
        $products = $this->productRepository->get($store);
        $categories = $this->categoryRepository->get($store);

        $productsArr = [];
        $combinations = [];

        foreach ($products as $product) {
            foreach ($product->product_categories as $productCategory) {
                if (!isset($productsArr[$productCategory->category_id])) {
                    $productsArr[$productCategory->category_id] = [
                        'category_id' => $productCategory->category_id,
                        'category_name' => $categories->where('id', $productCategory->category_id)->first()->name,
                        'products' => []
                    ];
                }

                if (!isset($combinations[$productCategory->category_id][$productCategory->product_id])) {
                    $productsArr[$productCategory->category_id]['products'][] = $product;
                    $combinations[$productCategory->category_id][$productCategory->product_id] = true;
                }
            }
        }

        return array_values($productsArr);
    }
}
