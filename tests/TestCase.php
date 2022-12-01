<?php

namespace Tests;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(
            ThrottleRequests::class
        );
    }

    protected function createStore(): Store
    {
        return Store::factory()->create();
    }

    protected function createCategory(string $storeId): Category
    {
        return Category::factory()->create([
            'store_id' => $storeId
        ]);
    }

    protected function createProduct(string $storeId): Product
    {
        return Product::factory()->create([
            'store_id' => $storeId
        ]);
    }
}
