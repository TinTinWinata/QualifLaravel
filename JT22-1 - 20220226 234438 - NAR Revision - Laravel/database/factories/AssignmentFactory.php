<?php

namespace Database\Factories;

use App\Models\Allocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $allocations =  Allocation::pluck('id')->toArray();

        return [
            'title' => $this->faker->text(10),
            'start_at' => $this->faker->dateTimeBetween('now', '2 weeks'),
            'end_at' => $this->faker->dateTimeBetween('2 weeks', '8 weeks'),
            'allocation_id' => $this->faker->randomElement($allocations),
            'assignment' => 'Kerjakanlah tugas berikut'
        ];
    }
}
