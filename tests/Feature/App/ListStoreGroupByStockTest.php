<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ListStoreGroupByStockTest extends TestCase
{
    use RefreshDatabase;

    private $qty;
    private $store;

    protected function setUp(): void
    {
        parent::setUp();

        $this->qty = rand(5, 25);

        for ($i = 0; $i < $this->qty; $i++) {
            $this->createStore([
                'products_with_stock' => ($i === 0) ? 0 : rand(5, 25)
            ]);
        }

        $this->jsonStructure = [
            'with_stock' => [
                '*' => [
                    'background',
                    'delivery',
                    'id',
                    'kind_of_attention',
                    'logo',
                    'name',
                    'opening_hours',
                    'price_with_discount',
                    'price_without_discount',
                    'products_with_stock',
                    'take_out',
                ]
            ],
            'without_stock' => [
                '*' => [
                    'background',
                    'delivery',
                    'id',
                    'kind_of_attention',
                    'logo',
                    'name',
                    'opening_hours',
                    'price_with_discount',
                    'price_without_discount',
                    'products_with_stock',
                    'take_out',
                ]
            ],
        ];
    }


    public function check_response_structure()
    {
        $response = $this->makeRequest();

        $response->assertStatus(200, $response->status());

        $response->assertJsonStructure($this->jsonStructure);
    }

    /** @test */
    public function check_response_with_stock_total()
    {
        $response = $this->makeRequest();
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(200, $response->status());

        $count = Store::where('products_with_stock', '>', '0')->count();

        $this->assertEquals(count($responseData['with_stock']), $count);
    }

    /** @test */
    public function check_response_without_stock_total()
    {
        $response = $this->makeRequest();
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(200, $response->status());

        $count = Store::where('products_with_stock', '0')->count();

        $this->assertEquals(count($responseData['without_stock']), $count);
    }

    /** @test */
    public function check_response_with_stock_data()
    {
        $response = $this->makeRequest();

        $response->assertStatus(200, $response->status());
        $responseData = $response->decodeResponseJson();

        $key = rand(0, count($responseData['with_stock']) - 1);
        $storeId = $responseData['with_stock'][$key]['id'];

        $store = Store::find($storeId);

        $this->assertEquals($responseData['with_stock'][$key]['id'], $store->id);
        $this->assertEquals($responseData['with_stock'][$key]['name'], $store->name);
        $this->assertEquals($responseData['with_stock'][$key]['background'], $store->background);
        $this->assertEquals($responseData['with_stock'][$key]['logo'], $store->logo);
        $this->assertEquals($responseData['with_stock'][$key]['products_with_stock'], $store->products_with_stock);
        $this->assertEquals($responseData['with_stock'][$key]['take_out'], $store->take_out);
        $this->assertEquals($responseData['with_stock'][$key]['delivery'], $store->delivery);
        $this->assertEquals($responseData['with_stock'][$key]['kind_of_attention'], $store->kind_of_attention);
        $this->assertEquals($responseData['with_stock'][$key]['opening_hours'], $store->opening_hours);
        $this->assertEquals($responseData['with_stock'][$key]['price_with_discount'], number_format($store->price_with_discount, 0, '', '.'));
        $this->assertEquals($responseData['with_stock'][$key]['price_without_discount'], number_format($store->price_without_discount, 0, '', '.'));
    }

    /** @test */
    public function check_response_without_stock_data()
    {
        $response = $this->makeRequest();

        $response->assertStatus(200, $response->status());
        $responseData = $response->decodeResponseJson();

        $key = rand(0, count($responseData['without_stock']) - 1);
        $storeId = $responseData['without_stock'][$key]['id'];

        $store = Store::find($storeId);

        $this->assertEquals($responseData['without_stock'][$key]['id'], $store->id);
        $this->assertEquals($responseData['without_stock'][$key]['name'], $store->name);
        $this->assertEquals($responseData['without_stock'][$key]['background'], $store->background);
        $this->assertEquals($responseData['without_stock'][$key]['logo'], $store->logo);
        $this->assertEquals($responseData['without_stock'][$key]['products_with_stock'], $store->products_without_stock);
        $this->assertEquals($responseData['without_stock'][$key]['take_out'], $store->take_out);
        $this->assertEquals($responseData['without_stock'][$key]['delivery'], $store->delivery);
        $this->assertEquals($responseData['without_stock'][$key]['kind_of_attention'], $store->kind_of_attention);
        $this->assertEquals($responseData['without_stock'][$key]['opening_hours'], $store->opening_hours);
        $this->assertEquals($responseData['without_stock'][$key]['price_with_discount'], number_format($store->price_with_discount, 0, '', '.'));
        $this->assertEquals($responseData['without_stock'][$key]['price_without_discount'], number_format($store->price_without_discount, 0, '', '.'));
    }

    private function makeRequest(): TestResponse
    {
        return $this->json(
            'GET',
            '/api/stores/',
            [],
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }
}
