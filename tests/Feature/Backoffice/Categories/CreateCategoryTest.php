<?php

namespace Tests\Feature\Backoffice\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class CreateCategoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $store;

    protected function setUp(): void
    {
        parent::setUp();

        $this->store = $this->createStore();
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
        $category = $this->createCategory($this->store->id);

        $data = $this->getData();
        $data['name'] = $category->name;

        $response = $this->makeRequest($data);

        $response->assertStatus(400, $response->status());
    }

    /** @test */
    public function can_be_created()
    {
        $data = $this->getData();
        $response = $this->makeRequest($data);

        $response->assertStatus(201, $response->status());

        $category = Category::latest()->first();

        $this->assertEquals($data['name'], $category->name);
    }

    private function getData(): array
    {
        return [
            'store_id' => $this->store->id,
            'name' => $this->faker->colorName() . ' category'
        ];
    }

    private function makeRequest(array $data = []): TestResponse
    {
        return $this->json(
            'POST',
            '/api/back-office/stores/' . $this->store->id . '/categories',
            $data,
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }
}
