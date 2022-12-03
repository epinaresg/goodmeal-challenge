<?php

namespace Tests\Feature\Products;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $store;
    private $qty;

    protected function setUp(): void
    {
        parent::setUp();

        $this->store = $this->createStore();

        $this->qty = rand(5, 25);
        for ($i = 0; $i < $this->qty; $i++) {
            $this->createCategory($this->store->id);
        }
    }

    /** @test */
    public function the_name_is_required()
    {
        $data = $this->getData();
        unset($data['name']);

        $response = $this->makeRequest($data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('name');

        $this->assertEquals(count($responseData['errors']), 1);
    }

    /** @test */
    public function the_name_cant_be_duplicated()
    {
        $product = $this->createProduct($this->store->id);

        $data = $this->getData();
        $data['name'] = $product->name;

        $response = $this->makeRequest($data);

        $response->assertStatus(400, $response->status());
    }

    /** @test */
    public function the_image_is_required()
    {
        $data = $this->getData();
        unset($data['image']);

        $response = $this->makeRequest($data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('image');
        $this->assertEquals(count($responseData['errors']), 1);
    }

    /** @test */
    public function the_stock_is_required()
    {
        $data = $this->getData();
        unset($data['stock']);

        $response = $this->makeRequest($data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('stock');
        $this->assertEquals(count($responseData['errors']), 1);
    }

    /** @test */
    public function the_price_without_discount_is_required()
    {
        $data = $this->getData();
        unset($data['price_without_discount']);

        $response = $this->makeRequest($data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('price_without_discount');
        $this->assertEquals(count($responseData['errors']), 2);
    }

    /** @test */
    public function the_price_with_discount_is_required()
    {
        $data = $this->getData();
        unset($data['price_with_discount']);

        $response = $this->makeRequest($data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('price_with_discount');
        $this->assertEquals(count($responseData['errors']), 1);
    }

    /** @test */
    public function can_be_created()
    {
        $data = $this->getData();
        $response = $this->makeRequest($data);

        $response->assertStatus(201, $response->status());

        $product = Product::latest()->first();

        $this->assertEquals($data['name'], $product->name);
        $this->assertEquals($data['image'], $product->image);
        $this->assertEquals($data['stock'], $product->stock);
        $this->assertEquals($data['price_without_discount'], $product->price_without_discount);
        $this->assertEquals($data['price_with_discount'], $product->price_with_discount);
        $this->assertEquals($product->price_without_discount > $product->price_with_discount, true);

        $this->assertEquals($product->product_categories->count(), count($data['product_categories']));
    }

    private function getData(): array
    {
        $price = rand(10000, 44000);

        $categories = Category::limit(rand(5, $this->qty))->get();

        $categoriesArr = [];
        foreach ($categories as $category) {
            $categoriesArr[] = ['category_id' => $category->id];
        }

        return [
            'store_id' => $this->store->id,

            'stock' => rand(0, 10),
            'name' => $this->faker->colorName() . ' product',
            'image' => $this->faker->url(),
            'price_without_discount' => $price,
            'price_with_discount' => rand(1000, $price - 1000),

            'product_categories' => $categoriesArr
        ];
    }

    private function makeRequest(array $data = []): TestResponse
    {
        return $this->json(
            'POST',
            '/api/back-office/stores/' . $this->store->id . '/products',
            $data,
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }
}
