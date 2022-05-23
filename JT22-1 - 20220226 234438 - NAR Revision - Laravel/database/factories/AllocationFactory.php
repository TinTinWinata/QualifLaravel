<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\Lecturer;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class AllocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */


    public function definition()
    {
        // $subject = $this->faker->randomElement(['Matematika', 'Biologi', 'Fisika', 'Character Building', 'Pancasila', 'Discreete Mathematics']);

        $subjectList =  Subject::pluck('subject_code')->toArray();
        $classroomList =  Classroom::pluck('classroom')->toArray();
        $lecturerList =  Lecturer::pluck('lecturer_code')->toArray();

        return [
            'classroom' => $this->faker->randomElement($classroomList),
            'subject_code' => $this->faker->randomElement($subjectList),
            'lecturer_code' => $this->faker->randomElement($lecturerList),
        ];
    }
}
