<?php

namespace Tests\Feature\Stores;

use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateStoreTest extends TestCase
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

        $response = $this->makeRequest($this->store->id, $data);
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

        $response = $this->makeRequest($this->store->id, $data);
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

        $response = $this->makeRequest($this->store->id, $data);
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

        $response = $this->makeRequest($this->store->id, $data);
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

        $response = $this->makeRequest($this->store->id, $data);
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

        $response = $this->makeRequest($this->store->id, $data);
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

        $response = $this->makeRequest($this->store->id, $data);
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

        $response = $this->makeRequest($this->store->id, $data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('rating');
        $this->assertEquals(count($responseData['errors']), 1);
    }


    /** @test */
    public function the_schedules_are_not_required()
    {
        $data = $this->getData();
        unset($data['schedules']);

        $response = $this->makeRequest($this->store->id, $data);

        $response->assertStatus(201, $response->status());
    }

    /** @test */
    public function the_schedules_take_out_hour_time_format_is_required()
    {
        $data = $this->getData();
        $data['schedules']['take_out']['start_hour'] = 'asdasd';
        $data['schedules']['take_out']['end_hour'] = 'asdasd';

        $response = $this->makeRequest($this->store->id, $data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('schedules.take_out.start_hour');
        $response->assertJsonValidationErrorFor('schedules.take_out.end_hour');
        $this->assertEquals(count($responseData['errors']), 2);
    }

    /** @test */
    public function the_schedules_delivery_hour_time_format_is_required()
    {
        $data = $this->getData();
        $data['schedules']['delivery']['start_hour'] = 'asdasd';
        $data['schedules']['delivery']['end_hour'] = 'asdasd';

        $response = $this->makeRequest($this->store->id, $data);
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(422, $response->status());
        $response->assertJsonValidationErrorFor('schedules.delivery.start_hour');
        $response->assertJsonValidationErrorFor('schedules.delivery.end_hour');
        $this->assertEquals(count($responseData['errors']), 2);
    }

    /** @test */
    public function can_be_updated()
    {
        $data = $this->getData();
        $response = $this->makeRequest($this->store->id, $data);

        $response->assertStatus(201, $response->status());

        $paymentMethod = Store::find($this->store->id);

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

        $startTime1 = rand(10, 14);
        $startTime2 = rand(10, 14);
        return [
            'logo' => $this->faker->url(),
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'address' => $this->faker->address(),
            'rating' => rand(1, 5),
            'delivery' => rand(0, 1),
            'take_out' => rand(0, 1),
            'schedules' => [
                'take_out' => [
                    'start_hour' => $startTime1 . ':00',
                    'end_hour' => rand($startTime1 + 1, 23) . ':00'
                ],
                'delivery' => [
                    'start_hour' => $startTime2 . ':00',
                    'end_hour' => rand($startTime2 + 1, 23) . ':00'
                ]
            ]
        ];
    }

    private function makeRequest(string $id, array $data = []): TestResponse
    {
        return $this->json(
            'PUT',
            '/api/back-office/stores/' . $id,
            $data,
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }
}
