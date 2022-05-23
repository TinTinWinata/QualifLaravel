<?php

namespace Database\Factories;

use App\Models\Allocation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AllocationDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $allocationList =  Allocation::pluck('id')->toArray();

        $studentList = array();
        $tempList =  User::pluck('student_code')->toArray();
        foreach ($tempList as $curr) {
            if ($curr != null) {
                array_push($studentList, $curr);
            }
        }

        return [
            'allocation_id' => $this->faker->randomElement($allocationList),
            'student_code' => $this->faker->randomElement($studentList),
        ];
    }
}
