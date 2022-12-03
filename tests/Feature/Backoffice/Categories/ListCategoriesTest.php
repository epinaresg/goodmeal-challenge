<?php

namespace Tests\Feature\Backoffice\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ListCategoriesTest extends TestCase
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
            $this->createCategory($this->store->id);
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
        $categoryId = $responseData['items'][$key]['id'];

        $category = Category::find($categoryId);

        $this->assertEquals($responseData['items'][$key]['id'], $category->id);
        $this->assertEquals($responseData['items'][$key]['name'], $category->name);
    }

    private function makeRequest(): TestResponse
    {
        return $this->json(
            'GET',
            '/api/back-office/stores/' . $this->store->id . '/categories',
            [],
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }
}
