<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ListProductsTest extends TestCase
{
    use RefreshDatabase;

    private $qty;
    private $store;

    protected function setUp(): void
    {
        parent::setUp();

        $this->store = $this->createStore();

        $this->qty = rand(5, 25);
        for ($i = 0; $i < $this->qty; $i++) {
            $this->createProduct($this->store->id);
        }

        $this->jsonStructure = [
            'items' => [
                '*' => [
                    'id',
                    'name',
                ]
            ],
            'pagination'
        ];
    }

    /** @test */
    public function check_response_total()
    {
        $response = $this->makeRequest();
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(200, $response->status());


        $this->assertEquals($responseData['pagination']['total'], $this->qty);
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

        $key = rand(0, count($responseData['items']) - 1);
        $productId = $responseData['items'][$key]['id'];

        $product = Product::find($productId);

        $this->assertEquals($responseData['items'][$key]['id'], $product->id);
        $this->assertEquals($responseData['items'][$key]['name'], $product->name);
    }

    private function makeRequest(): TestResponse
    {
        return $this->json(
            'GET',
            '/api/back-office/stores/' . $this->store->id . '/products',
            [],
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }
}
