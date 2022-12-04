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
            $minStart = 0;
            $maxEnd = 0;
            if ($store->delivery == 1) {
                $start = rand(9, 14);
                $end = rand($start + 1, 23);
                StoreSchedule::factory()->create([
                    'type' => 'delivery',
                    'store_id' => $store->id,
                    'start_hour' => $start . ':00',
                    'end_hour' => $end . ':00',
                ]);

                $minStart = $start;
                $maxEnd = $end;
            }

            if ($store->take_out == 1) {
                $start = rand(9, 14);
                $end = rand($start + 1, 23);

                if ($start < $minStart || $minStart == 0) {
                    $minStart = $start;
                }

                if ($end < $maxEnd || $maxEnd == 0) {
                    $maxEnd = $end;
                }

                StoreSchedule::factory()->create([
                    'type' => 'take_out',
                    'store_id' => $store->id,
                    'start_hour' => $start . ':00',
                    'end_hour' => $end . ':00',
                ]);
            }

            if ($minStart > 0 && $maxEnd > 0) {
                $store->opening_hours = $minStart . ':00 - ' . $maxEnd . ':00 hrs';
                $store->save();
            }
        }
    }
}
