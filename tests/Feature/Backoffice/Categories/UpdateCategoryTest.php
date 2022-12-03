<?php

namespace Tests\Feature\Backoffice\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->store = $this->createStore();
        $this->category = $this->createCategory($this->store->id);
    }

    /** @test */
    public function the_name_is_required()
    {
        $data = $this->getData();
        unset($data['name']);

        $response = $this->makeRequest($this->category->id, $data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('name');
        $this->assertEquals(count($responseData['errors']), 1);
    }

    /** @test */
    public function the_name_cant_be_duplicated()
    {
        $data = $this->getData();
        $category = Category::create($data);

        $data = $this->getData();
        $data['name'] = $category->name;

        $response = $this->makeRequest($this->category->id, $data);

        $response->assertStatus(400, $response->status());
    }

    /** @test */
    public function can_be_updated()
    {
        $data = $this->getData();
        $response = $this->makeRequest($this->category->id, $data);

        $response->assertStatus(201, $response->status());

        $category = Category::find($this->category->id);

        $this->assertEquals($data['name'], $category->name);
    }

    private function getData(): array
    {
        return [
            'store_id' => $this->store->id,
            'name' => $this->faker->colorName() . ' category'
        ];
    }

    private function makeRequest(string $id, array $data = []): TestResponse
    {
        return $this->json(
            'PUT',
            '/api/back-office/stores/' . $this->store->id . '/categories/' . $id,
            $data,
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }
}
