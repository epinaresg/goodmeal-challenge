<?php

namespace Tests\Feature\App;

use App\Models\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class SaveAddressTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $store;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function the_address_is_required()
    {
        $data = $this->getData();
        unset($data['address']);

        $response = $this->makeRequest($data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('address');
        $this->assertEquals(count($responseData['errors']), 1);
    }

    /** @test */
    public function the_latitude_is_required()
    {
        $data = $this->getData();
        unset($data['latitude']);

        $response = $this->makeRequest($data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('latitude');
        $this->assertEquals(count($responseData['errors']), 1);
    }

    /** @test */
    public function the_longitude_is_required()
    {
        $data = $this->getData();
        unset($data['longitude']);

        $response = $this->makeRequest($data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('longitude');
        $this->assertEquals(count($responseData['errors']), 1);
    }

    /** @test */
    public function can_be_created()
    {
        $data = $this->getData();
        $response = $this->makeRequest($data);

        $response->assertStatus(201, $response->status());

        $address = Address::latest()->first();

        $this->assertEquals($data['address'], $address->address);
        $this->assertEquals($data['latitude'], $address->latitude);
        $this->assertEquals($data['longitude'], $address->longitude);
    }

    /** @test */
    public function the_created_address_is_default()
    {
        $data = $this->getData();
        $response = $this->makeRequest($data);

        $response->assertStatus(201, $response->status());

        $address = Address::where('default', 1)->first();

        $this->assertEquals($data['address'], $address->address);
        $this->assertEquals($data['latitude'], $address->latitude);
        $this->assertEquals($data['longitude'], $address->longitude);
    }

    private function getData(): array
    {
        return [
            'address' => $this->faker->address(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];
    }


    private function makeRequest(array $data): TestResponse
    {
        return $this->json(
            'POST',
            '/api/addresses/',
            $data,
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }
}
