<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Store;
use App\Models\StoreSchedule;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
            $qty = rand(5, 10);

            for ($i=0; $i < $qty; $i++) {
                Category::factory()->create([
                    'store_id' => $store->id
                ]);
            }
        }
    }
}
