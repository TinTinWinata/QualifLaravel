<?php

namespace Database\Factories;

use App\Models\Forum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $forumList =  Forum::pluck('forum_id')->toArray();
        $userList = User::pluck('id')->toArray();

        return [
            'forum_id' => $this->faker->randomElement($forumList),
            'user_id' => $this->faker->randomElement($userList),
            'content' => $this->faker->text(100),
        ];
    }
}
