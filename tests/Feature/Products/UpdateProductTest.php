<?php

namespace Tests\Feature\Products;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdateProductTest extends TestCase
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

        $response = $this->makeRequest($this->product->id, $data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('name');
        $this->assertEquals(count($responseData['errors']), 1);
    }

    /** @test */
    public function the_name_cant_be_duplicated()
    {
        $data = $this->getData();
        $product = Product::create($data);

        $data = $this->getData();
        $data['name'] = $product->name;

        $response = $this->makeRequest($this->product->id, $data);

        $response->assertStatus(400, $response->status());
    }

    /** @test */
    public function can_be_updated()
    {
        $data = $this->getData();
        $response = $this->makeRequest($this->product->id, $data);

        $response->assertStatus(201, $response->status());

        $product = Product::find($this->product->id);

        $this->assertEquals($data['name'], $product->name);
        $this->assertEquals($data['image'], $product->image);
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
            'name' => $this->faker->colorName() . ' product',
            'image' => $this->faker->url(),
            'price_without_discount' => $price,
            'price_with_discount' => rand(1000, $price - 1000),

            'product_categories' => $categoriesArr
        ];
    }

    private function makeRequest(string $id, array $data = []): TestResponse
    {
        return $this->json(
            'PUT',
            '/api/back-office/stores/' . $this->store->id . '/products/' . $id,
            $data,
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }
}
