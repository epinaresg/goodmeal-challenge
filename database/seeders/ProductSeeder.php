<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Store;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = Store::all();

        foreach ($stores as  $store) {
            $qty = rand(5, 20);

            $stock = rand(0, 1);

            for ($i=0; $i < $qty; $i++) {
                $data = [
                    'store_id' => $store->id
                ];

                if ($stock == 0) {
                    $data['stock'] = 0;
                }

                $categories = $store->categories->shuffle()->slice(5);

                if ($categories->count() > 0) {
                    $product = Product::factory()->create($data);


                    foreach ($categories as $category) {
                        ProductCategory::create([
                            'store_id' => $store->id,
                            'product_id' => $product->id,
                            'category_id' => $category->id
                        ]);
                    }
                }
            }


            $products = $store->products;

            $priceWithDiscount = $products->min('price_with_discount');
            $priceWithouDiscount = $products->min('price_without_discount');

            $store->price_with_discount = ($priceWithDiscount ? $priceWithDiscount : 0);
            $store->price_without_discount = ($priceWithouDiscount ? $priceWithouDiscount : 0);


            $productsWithStock = $products->where('stock', '>', 0)->count();

            $store->products_with_stock = $productsWithStock;

            $store->save();
        }
    }
}
