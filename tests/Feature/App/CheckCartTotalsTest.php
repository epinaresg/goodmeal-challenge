<?php

namespace Tests\Feature\App;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Store;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class CheckCartTotalsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $store;

    protected function setUp(): void
    {
        parent::setUp();

        Store::factory()->times(20)->create();

        $this->seed(CategorySeeder::class);
        $this->seed(ProductSeeder::class);

        $this->store = Store::inRandomOrder()->where('products_with_stock', '>', 1)->first();
    }


    /** @test */
    public function check_response_totals()
    {
        $order = Order::factory()->create([
            'store_id' => $this->store->id
        ]);

        $productQty = [];
        for ($i=0; $i < rand(2, 10); $i++) {
            $data = $this->getData();

            if (!isset($productQty[$data['product_id']])) {
                $product = Product::find($data['product_id']);

                $productQty[$data['product_id']] = [
                    'qty' => 0,
                    'price' => $product->price_with_discount,
                    'total' => 0
                ];
            }

            $productQty[$data['product_id']]['qty'] += 1;
            $productQty[$data['product_id']]['total'] = $productQty[$data['product_id']]['qty'] * $productQty[$data['product_id']]['price'];

            $response = $this->addProductToCartRequest($data);
            $response->assertStatus(201, $response->status());
        }

        $productQty = collect($productQty);

        $response = $this->getCartRequest();
        $response->assertStatus(200, $response->status());

        $responseData = $response->decodeResponseJson();


        $total = 0;
        $qty = 0;
        foreach ($productQty as $p) {
            $total += $p['total'];
            $qty += $p['qty'];
        }

        $this->jsonStructure = [
            'id',
            'total',
            'total_delivery',
            'total_with_delivery',
            'qty_products',
            'products' => [
                '*' => []
            ]
        ];

        $order = $order->fresh();

        $this->assertEquals($responseData['id'], $order->id);

        $this->assertEquals($responseData['total'], number_format($total, 0, '', '.'));
        $this->assertEquals($responseData['total'], number_format($order->total, 0, '', '.'));

        $this->assertEquals($responseData['total_delivery'], number_format(5000, 0, '', '.'));
        $this->assertEquals($responseData['total_delivery'], number_format($order->total_delivery, 0, '', '.'));

        $this->assertEquals($responseData['total_with_delivery'], number_format($total + 5000, 0, '', '.'));
        $this->assertEquals($responseData['total_with_delivery'], number_format($order->total_with_delivery, 0, '', '.'));

        $this->assertEquals($responseData['qty_products'], $order->qty_products);
        $this->assertEquals($responseData['qty_products'], $qty);

        $this->assertEquals(count($responseData['products']), count($productQty));
        $this->assertEquals(count($responseData['products']), $order->order_products->count());
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
}
