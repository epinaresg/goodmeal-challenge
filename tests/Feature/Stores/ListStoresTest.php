<?php

namespace Tests\Feature\Stores;

use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ListStoresTest extends TestCase
{
    use RefreshDatabase;

    private $qty;

    protected function setUp(): void
    {
        parent::setUp();

        $this->qty = rand(5, 25);
        for ($i = 0; $i < $this->qty; $i++) {
            $this->createStore();
        }

        $this->jsonStructure = [
            'items' => [
                '*' => [
                    'id',
                    'logo',
                    'name',
                    'slug',
                    'address',
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
        $storeId = $responseData['items'][$key]['id'];

        $store = Store::find($storeId);

        $this->assertEquals($responseData['items'][$key]['id'], $store->id);
        $this->assertEquals($responseData['items'][$key]['name'], $store->name);
        $this->assertEquals($responseData['items'][$key]['logo'], $store->logo);
        $this->assertEquals($responseData['items'][$key]['address'], $store->address);
        $this->assertEquals($responseData['items'][$key]['slug'], $store->slug);
    }

    private function makeRequest(): TestResponse
    {
        return $this->json(
            'GET',
            '/api/back-office/stores',
            [],
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }
}
