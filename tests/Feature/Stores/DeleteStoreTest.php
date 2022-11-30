<?php

namespace Tests\Feature\Stores;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DeleteStoreTest extends TestCase
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
    public function invalid_id()
    {
        $response = $this->makeRequest(
            $this->store->id . '123',
        );

        $response->assertStatus(404, $response->status());
    }

    /** @test */
    public function can_be_deleted()
    {
        $response = $this->makeRequest(
            $this->store->id,
        );

        $response->assertStatus(201, $response->status());

        $this->assertNotEquals($this->store, null);
        $this->assertNotEquals($this->store->fresh()->deleted_at, null);
    }

    private function makeRequest(string $id): TestResponse
    {
        return $this->json(
            'DELETE',
            '/api/back-office/stores/' . $id,
            [],
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }
}
