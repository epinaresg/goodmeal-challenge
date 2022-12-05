<?php

namespace Tests\Feature\App;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Store;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\StoreScheduleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class CloseCartTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $store;
    private $address;

    protected function setUp(): void
    {
        parent::setUp();

        Store::factory()->times(10)->create();
        $this->address = Address::factory()->create([
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
    }


    /** @test */
    public function close_cart_delivery()
    {
        $order = Order::factory()->create([
            'store_id' => $this->store->id
        ]);

        for ($i=0; $i < rand(2, 10); $i++) {
            $data = $this->getData();

            $response = $this->addProductToCartRequest($data);
            $response->assertStatus(201, $response->status());
        }

        $order = $order->fresh();

        $total_delivery = $order->total_delivery;
        $total_with_delivery = $order->total_with_delivery;

        $response = $this->closeCartRequest([
            'type' => 'delivery'
        ]);
        $response->assertStatus(201, $response->status());

        $order = $order->fresh();

        $this->assertEquals($order->store_name, $order->store->name);
        $this->assertEquals($order->store_address, $order->store->address);
        $this->assertEquals($order->code != '' ? true : false, true);
        $this->assertEquals($order->order_type, 'delivery');
        $this->assertEquals($order->order_date, date('Y-m-d'));
        $this->assertEquals($order->order_time != '' ? true : false, true);
        $this->assertEquals($order->open, 0);


        $this->assertEquals($order->customer_address, $this->address->address);
        $this->assertEquals($order->state, 'Por entregar');
        $this->assertEquals($order->total, $total_with_delivery);
        $this->assertEquals($order->total_with_delivery, $total_with_delivery);
        $this->assertEquals($order->total_delivery, $total_delivery);
    }

    /** @test */
    public function close_cart_take_out()
    {
        $order = Order::factory()->create([
            'store_id' => $this->store->id
        ]);

        for ($i=0; $i < rand(2, 10); $i++) {
            $data = $this->getData();

            $response = $this->addProductToCartRequest($data);
            $response->assertStatus(201, $response->status());
        }

        $order = $order->fresh();

        $total = $order->total;

        $response = $this->closeCartRequest([
            'type' => 'take_out'
        ]);
        $response->assertStatus(201, $response->status());

        $order = $order->fresh();

        $this->assertEquals($order->store_name, $order->store->name);
        $this->assertEquals($order->store_address, $order->store->address);
        $this->assertEquals($order->code != '' ? true : false, true);
        $this->assertEquals($order->order_type, 'take_out');
        $this->assertEquals($order->order_date, date('Y-m-d'));
        $this->assertEquals($order->order_time != '' ? true : false, true);
        $this->assertEquals($order->open, 0);


        $this->assertEquals($order->customer_address, null);
        $this->assertEquals($order->state, 'Por recoger');
        $this->assertEquals($order->total, $total);
        $this->assertEquals($order->total_delivery, 0);
        $this->assertEquals($order->total_with_delivery, 0);
    }

    private function getData(): array
    {
        $productCategory = $this->store->product_categories->shuffle()->slice(0, 1)->first();
        return [
            'product_id' => $productCategory->product_id,
        ];
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
