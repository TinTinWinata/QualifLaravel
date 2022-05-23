<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $subject = $this->faker->randomElement(['Matematika', 'Biologi', 'Fisika', 'Character Building', 'Pancasila', 'Discreete Mathematics']);

        return [

            'subject_name' => $subject,
            'subject_code' => strtoupper($this->faker->bothify('??##')),

        ];
    }
}
