<?php

namespace Tests\Feature\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $product;
    private $store;

    protected function setUp(): void
    {
        parent::setUp();

        $this->store = $this->createStore();
        $this->product = $this->createProduct($this->store->id);
    }

    /** @test */
    public function invalid_id()
    {
        $response = $this->makeRequest(
            $this->product->id . '123',
        );

        $response->assertStatus(404, $response->status());
    }

    /** @test */
    public function can_be_deleted()
    {
        $response = $this->makeRequest(
            $this->product->id,
        );

        $response->assertStatus(201, $response->status());

        $this->assertNotEquals($this->product, null);
        $this->assertNotEquals($this->product->fresh()->deleted_at, null);
    }

    private function makeRequest(string $id): TestResponse
    {
        return $this->json(
            'DELETE',
            '/api/back-office/stores/' . $this->store->id . '/products/' . $id,
            [],
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }
}
