<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\StoreSchedule;
use Illuminate\Database\Seeder;

class StoreScheduleSeeder extends Seeder
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
            if ($store->take_out == 1) {
                $start = rand(9, 14);
                StoreSchedule::factory()->create([
                    'type' => 'take_out',
                    'store_id' => $store->id,
                    'start_hour' => $start . ':00',
                    'end_hour' => rand($start + 1, 23) . ':00',
                ]);
            }

            if ($store->delivery == 1) {
                $start = rand(9, 14);
                StoreSchedule::factory()->create([
                    'type' => 'delivery',
                    'store_id' => $store->id,
                    'start_hour' => $start . ':00',
                    'end_hour' => rand($start + 1, 23) . ':00',
                ]);
            }
        }
    }
}
