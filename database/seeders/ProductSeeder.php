<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Store;
use App\Models\StoreSchedule;
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

        foreach ($stores as $store) {
            $qty = rand(5, 20);


            for ($i=0; $i < $qty; $i++) {
                $product = Product::factory()->create([
                    'store_id' => $store->id
                ]);

                $categories = $store->categories->shuffle()->slice(5);

                foreach ($categories as $category) {
                    ProductCategory::create([
                        'store_id' => $store->id,
                        'product_id' => $product->id,
                        'category_id' => $category->id
                    ]);
                }
            }

            $products = $store->products;

            $priceWithDiscount = $products->min('price_with_discount');
            $priceWithouDiscount = $products->min('price_without_discount');

            $store->price_with_discount = $priceWithDiscount;
            $store->price_without_discount = $priceWithouDiscount;


            $productsWithStock = $products->where('stock', '>', 0)->count();

            $store->products_with_stock = $productsWithStock;

            $store->save();
        }
    }
}
