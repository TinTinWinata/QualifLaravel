<?php

namespace Database\Factories;

use App\Models\Allocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ForumFactory extends Factory
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
            'allocation_id' => $this->faker->randomElement($allocations),
            'content' => $this->faker->text,
            'creator' => $this->faker->name,
            'title' => $this->faker->text(10),
            'created_at' => $this->faker->dateTimeBetween('-2 week', '-1 week'),
            'updated_at' => $this->faker->dateTimeBetween('-1 week', '0 week')
        ];
    }
}
