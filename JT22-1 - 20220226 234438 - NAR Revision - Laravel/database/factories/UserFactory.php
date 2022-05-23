<?php

namespace Database\Factories;

use App\Models\Lecturer;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function getLecturerCode()
    {
        $userList = User::all();
        $lecturerList = Lecturer::all();

        if (count($userList) >= count($lecturerList)) {
            return null;
        } else {
            $lecturerList =  Lecturer::pluck('lecturer_code')->toArray();
            return $this->faker->unique()->randomElement($lecturerList);
        }
    }
    public function definition()
    {
        $role = 'lecturer';
        $student_code = null;
        $lecturer_code = $this->getLecturerCode();

        if ($lecturer_code == null) {
            $role = 'student';
        }

        if ($role == 'student') {
            $student_code = $this->faker->unique()->numberBetween($min = 1111111111, $max = 9999999999);
        } else {
            $student_code = null;
        }



        return [
            'role' => $role,
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->email(),
            'student_code' => $student_code,
            'password' => bcrypt('asd'),
            'remember_token' => Str::random(10),
            'lecturer_code' => $lecturer_code,
        ];
    }

    public function validateLecturer($code)
    {
        $lecturerList = Lecturer::all();
        foreach ($lecturerList as $cur) {
        }
    }
    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
