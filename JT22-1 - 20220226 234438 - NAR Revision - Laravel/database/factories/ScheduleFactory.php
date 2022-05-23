<?php

namespace Database\Factories;

use App\Models\Allocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $allocationList =  Allocation::pluck('id')->toArray();

        $timeList = ['07.20 - 09.00', '09.20 - 11.00', '13.20 - 15.00', '15.20 - 17.00', '17.20 - 19.00'];

        return [
            'allocation_id' => $this->faker->randomElement($allocationList),
            'date' => $this->faker->dateTimeBetween('0 week', '+1 week'),
            'time' => $this->faker->randomElement($timeList),
        ];
    }
}
