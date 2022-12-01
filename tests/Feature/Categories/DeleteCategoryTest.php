<?php

namespace Tests\Feature\Categories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DeleteCategoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $category;
    private $store;

    protected function setUp(): void
    {
        parent::setUp();

        $this->store = $this->createStore();
        $this->category = $this->createCategory($this->store->id);
    }

    /** @test */
    public function invalid_id()
    {
        $response = $this->makeRequest(
            $this->category->id . '123',
        );

        $response->assertStatus(404, $response->status());
    }

    /** @test */
    public function can_be_deleted()
    {
        $response = $this->makeRequest(
            $this->category->id,
        );

        $response->assertStatus(201, $response->status());

        $this->assertNotEquals($this->category, null);
        $this->assertNotEquals($this->category->fresh()->deleted_at, null);
    }

    private function makeRequest(string $id): TestResponse
    {
        return $this->json(
            'DELETE',
            '/api/back-office/stores/' . $this->store->id . '/categories/' . $id,
            [],
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }
}
