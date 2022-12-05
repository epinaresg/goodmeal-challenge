<?php

namespace Tests\Feature\App;

use App\Models\Address;
use App\Models\Order;

use App\Models\Store;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\StoreScheduleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ListOrdersTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $store;

    protected function setUp(): void
    {
        parent::setUp();

        Store::factory()->times(10)->create();
        Address::factory()->create([
            'default' => 1
        ]);

        $this->seed(CategorySeeder::class);
        $this->seed(ProductSeeder::class);

        $this->store = Store::inRandomOrder()->where('products_with_stock', '>', 1)->first();

        if (!$this->store) {
            dd('Try again');
        }

        $this->store->delivery = 1;
        $this->store->save();

        $this->store->take_out = 1;
        $this->store->save();

        $this->seed(StoreScheduleSeeder::class);

        $this->jsonStructure = [
            '*' => [
                'id',
                'store_name',
                'code',
                'total',
                'order_type',
                'order_date',
                'order_time',
                'state',
            ]
        ];
    }



    /** @test */
    public function check_response_structure()
    {
        $this->generateData();

        $response = $this->makeRequest();

        $response->assertStatus(200, $response->status());

        $response->assertJsonStructure($this->jsonStructure);
    }


    /** @test */
    public function check_response_data()
    {
        $this->generateData();

        $response = $this->makeRequest();
        $responseData = $response->decodeResponseJson();

        $response->assertStatus(200, $response->status());

        $count = Order::where('open', '0')->count();
        $this->assertEquals(count($responseData), $count);


        $key = rand(0, count($responseData) - 1);
        $orderId = $responseData[$key]['id'];

        $order = Order::find($orderId);

        $this->assertEquals($responseData[$key]['id'], $order->id);
        $this->assertEquals($responseData[$key]['code'], $order->code);
        $this->assertEquals($responseData[$key]['order_date'], date('d/m/Y', strtotime($order->order_date)));
        $this->assertEquals($responseData[$key]['order_time'], $order->order_time);
        $this->assertEquals($responseData[$key]['order_type'], $order->order_type);
        $this->assertEquals($responseData[$key]['state'], $order->state);
        $this->assertEquals($responseData[$key]['store_name'], $order->store_name);
        $this->assertEquals($responseData[$key]['total'], number_format($order->total, 0, '', '.'));
    }


    public function generateData()
    {
        for ($i=0; $i < rand(2, 10); $i++) {
            Order::factory()->create([
                'store_id' => $this->store->id
            ]);

            for ($i=0; $i < rand(2, 10); $i++) {
                $data = $this->getData();

                $this->addProductToCartRequest($data);
            }

            $this->closeCartRequest([
                'type' => rand(0, 1) == 1 ? 'delivery' : 'take_out'
            ]);
        }
    }

    private function getData(): array
    {
        $productCategory = $this->store->product_categories->shuffle()->slice(0, 1)->first();
        return [
            'product_id' => $productCategory->product_id,
        ];
    }

    private function makeRequest(): TestResponse
    {
        return $this->json(
            'GET',
            '/api/orders',
            [],
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }

    private function addProductToCartRequest(array $data): TestResponse
    {
        return $this->json(
            'POST',
            '/api/stores/' . $this->store->id . '/carts',
            $data,
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }


    private function getCartRequest(): TestResponse
    {
        return $this->json(
            'GET',
            '/api/stores/' . $this->store->id . '/carts',
            [],
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }


    private function closeCartRequest(array $data): TestResponse
    {
        return $this->json(
            'POST',
            '/api/stores/' . $this->store->id . '/carts/close',
            $data,
            [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ]
        );
    }
}
