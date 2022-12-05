<?php

namespace Tests\Feature\App;

use App\Models\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class GetDefaultAddressTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $address;

    protected function setUp(): void
    {
        parent::setUp();

        for ($i=0; $i < 20; $i++) {
            $address = Address::factory()->create(['default' => 0]);
            ;
            if (rand(0, 1) == 1 && !$this->address) {
                $address->default = 1;
                $address->save();
                $this->address = $address;
            }

            if ($i === 19 && !$this->address) {
                $address->default = 1;
                $address->save();
                $this->address = $address;
            }
        }

        $this->jsonStructure = [
            'id',
            'address',
            'latitude',
            'longitude',
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

        $this->assertEquals($responseData['id'], $this->address->id);
        $this->assertEquals($responseData['address'], $this->address->address);
        $this->assertEquals($responseData['latitude'], $this->address->latitude);
        $this->assertEquals($responseData['longitude'], $this->address->longitude);
    }


    private function makeRequest(): TestResponse
    {
        return $this->json(
            'GET',
            '/api/addresses/',
            [],
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }
}
