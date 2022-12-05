<?php

namespace Tests\Feature\App;

use App\Models\Order;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class GetCartTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $address;

    protected function setUp(): void
    {
        parent::setUp();

        $this->store = $this->createStore();

        $this->seed(CategorySeeder::class);
        $this->seed(ProductSeeder::class);

        $this->jsonStructure = [
            'id',
            'total',
            'total_delivery',
            'total_with_delivery',
            'qty_products',
            'products' => [
                '*' => []
            ]
        ];
    }


    /** @test */
    public function check_response_structure()
    {
        $response = $this->makeRequest();

        $response->assertStatus(200, $response->status());

        $response->assertJsonStructure($this->jsonStructure);
    }

    /** @test */
    public function check_response_data()
    {
        $response = $this->makeRequest();

        $response->assertStatus(200, $response->status());
        $responseData = $response->decodeResponseJson();

        $order = Order::where('store_id', $this->store->id)->where('open', 1)->first();

        $this->assertEquals($responseData['id'], $order->id);
        $this->assertEquals($responseData['total'], number_format($order->total, 0, '', '.'));
        $this->assertEquals($responseData['total_with_delivery'], number_format($order->total_with_delivery, 0, '', '.'));
        $this->assertEquals($responseData['qty_products'], $order->qty_products);
        $this->assertEquals(count($responseData['products']), count($order->products));
    }


    private function makeRequest(): TestResponse
    {
        return $this->json(
            'GET',
            '/api/stores/' . $this->store->id . '/carts',
            [],
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }
}
