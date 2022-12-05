<?php

namespace Tests\Feature\App;

use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ShowStoreTest extends TestCase
{
    use RefreshDatabase;

    private $store;

    protected function setUp(): void
    {
        parent::setUp();

        $this->store = $this->createStore();

        $this->seed(CategorySeeder::class);
        $this->seed(ProductSeeder::class);

        $this->store = $this->store->fresh();

        $this->jsonStructure = [
            'store' => [
                'id',
                'name',
                'logo',
                'background',
                'address',
                'slug',
                'delivery',
                'take_out',
                'rating',
                'products_with_stock',
                'schedules' => [
                    '*' => [
                        'id',
                        'type',
                        'start_hour',
                        'end_hour'
                    ]
                ]
            ],
            'products' => [
                '*' => [
                    'category_id',
                    'category_name',
                    'items' => [
                        '*' => [
                            'id',
                            'name',
                            'image',
                            'price_with_discount',
                            'price_without_discount'
                        ]
                    ]
                ]
            ],
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

        $this->assertEquals($responseData['store']['id'], $this->store->id);
        $this->assertEquals($responseData['store']['name'], $this->store->name);
        $this->assertEquals($responseData['store']['logo'], $this->store->logo);
        $this->assertEquals($responseData['store']['background'], $this->store->background);
        $this->assertEquals($responseData['store']['address'], $this->store->address);
        $this->assertEquals($responseData['store']['slug'], $this->store->slug);
        $this->assertEquals($responseData['store']['delivery'], $this->store->delivery);
        $this->assertEquals($responseData['store']['take_out'], $this->store->take_out);
        $this->assertEquals($responseData['store']['rating'], $this->store->rating);
        $this->assertEquals($responseData['store']['products_with_stock'], $this->store->products_with_stock);

        $this->assertEquals(count($responseData['store']['schedules']), $this->store->schedules->count());
        $this->assertEquals(count($responseData['products']), $this->store->product_categories->groupBy('category_id')->count());
    }


    private function makeRequest(): TestResponse
    {
        return $this->json(
            'GET',
            '/api/stores/' . $this->store->id,
            [],
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }
}
