<?php

namespace App\UseCases\Api\App;

use App\Models\Store;
use App\Repositories\StoreRespository;
use App\Repositories\StoreScheduleRepository;

class SetOpeningHoursUseCase
{
    private $storeRepository;
    private $storeScheduleRepository;
    public function __construct()
    {
        $this->storeRepository = new StoreRespository();
        $this->storeScheduleRepository = new StoreScheduleRepository();
    }

    public function __invoke(Store $store): void
    {
        $schedules = $this->storeScheduleRepository->get($store);


        $minStart = 0;
        $maxEnd = 0;

        $data = [];
        if ($store->delivery == 1) {
            $schedule = $schedules->where('type', 'delivery')->first();

            if ($schedule) {
                $minStart = substr($schedule->start_hour, 0, 2);
                $maxEnd = substr($schedule->end_hour, 0, 2);
            } else {
                $data['delivery'] = 0;
            }
        }

        if ($store->take_out == 1) {
            $schedule = $schedules->where('type', 'take_out')->first();

            if ($schedule) {
                if (substr($schedule->start_hour, 0, 2) < $minStart || $minStart == 0) {
                    $minStart = substr($schedule->start_hour, 0, 2);
                }

                if (substr($schedule->end_hour, 0, 2) < $maxEnd || $maxEnd == 0) {
                    $maxEnd = substr($schedule->end_hour, 0, 2);
                }
            } else {
                $data['take_out'] = 0;
            }
        }

        $data['opening_hours'] = $minStart . ':00 - ' . $maxEnd . ':00 hrs';

        $this->storeRepository->update($store, $data);
    }
}
