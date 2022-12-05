<?php

namespace Tests\Feature\App;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Store;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class AddProductToCartTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $store;

    protected function setUp(): void
    {
        parent::setUp();

        Store::factory()->times(20)->create();

        $this->seed(CategorySeeder::class);
        $this->seed(ProductSeeder::class);

        $this->store = Store::inRandomOrder()->where('products_with_stock', '>', 1)->first();
    }

    /** @test */
    public function the_product_id_is_required()
    {
        $data = $this->getData();
        unset($data['product_id']);

        $response = $this->makeRequest($data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('product_id');
        $this->assertEquals(count($responseData['errors']), 1);
    }

    /** @test */
    public function can_be_created()
    {
        Order::factory()->create([
            'store_id' => $this->store->id
        ]);

        $data = $this->getData();
        $response = $this->makeRequest($data);

        $response->assertStatus(201, $response->status());

        $orderProduct = OrderProduct::latest()->first();

        $this->assertEquals($data['product_id'], $orderProduct->product_id);
    }

    private function getData(): array
    {
        $productCategory = $this->store->product_categories->shuffle()->slice(0, 1)->first();
        return [
            'product_id' => $productCategory->product_id,
        ];
    }


    private function makeRequest(array $data): TestResponse
    {
        return $this->json(
            'POST',
            '/api/stores/' . $this->store->id . '/carts',
            $data,
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }
}
