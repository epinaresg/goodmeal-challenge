<?php

namespace Tests\Feature\Stores;

use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateStoreTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
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
    public function the_logo_is_required()
    {
        $data = $this->getData();
        unset($data['logo']);

        $response = $this->makeRequest($data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('logo');
        $this->assertEquals(count($responseData['errors']), 1);
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
    public function the_delivery_flag_is_required()
    {
        $data = $this->getData();
        unset($data['delivery']);

        $response = $this->makeRequest($data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('delivery');
        $this->assertEquals(count($responseData['errors']), 1);
    }

    /** @test */
    public function the_delivery_flag_cant_be_greater_than_1()
    {
        $data = $this->getData();
        $data['delivery'] = 2;

        $response = $this->makeRequest($data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('delivery');
        $this->assertEquals(count($responseData['errors']), 1);
    }

    /** @test */
    public function the_take_out_flag_is_required()
    {
        $data = $this->getData();
        unset($data['take_out']);

        $response = $this->makeRequest($data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('take_out');
        $this->assertEquals(count($responseData['errors']), 1);
    }

    /** @test */
    public function the_take_out_flag_cant_be_greater_than_1()
    {
        $data = $this->getData();
        $data['take_out'] = 2;

        $response = $this->makeRequest($data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('take_out');
        $this->assertEquals(count($responseData['errors']), 1);
    }


    /** @test */
    public function the_rating_is_required()
    {
        $data = $this->getData();
        unset($data['rating']);

        $response = $this->makeRequest($data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('rating');
        $this->assertEquals(count($responseData['errors']), 1);
    }

    /** @test */
    public function can_be_created()
    {
        $data = $this->getData();
        $response = $this->makeRequest($data);

        $response->assertStatus(201, $response->status());

        $paymentMethod = Store::latest()->first();

        $this->assertEquals($data['name'], $paymentMethod->name);
        $this->assertEquals($data['logo'], $paymentMethod->logo);
        $this->assertEquals($data['address'], $paymentMethod->address);
        $this->assertEquals($data['delivery'], $paymentMethod->delivery);
        $this->assertEquals($data['take_out'], $paymentMethod->take_out);
        $this->assertEquals($data['rating'], $paymentMethod->rating);
    }

    private function getData(): array
    {
        $name = $this->faker->company();
        return [
            'logo' => $this->faker->url(),
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'address' => $this->faker->address(),
            'rating' => rand(1, 5),
            'delivery' => rand(0, 1),
            'take_out' => rand(0, 1),
        ];
    }

    private function makeRequest(array $data = []): TestResponse
    {
        return $this->json(
            'POST',
            '/api/back-office/stores',
            $data,
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }
}
