<?php

namespace Database\Seeders;

use App\Models\Allocation;
use App\Models\AllocationDetail;
use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Forum;
use App\Models\Lecturer;
use App\Models\Reply;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Lecturer::factory(10)->create();
        for ($i = 0; $i < 20; $i++) {
            User::factory(1)->create();
        }
        Classroom::factory(10)->create();
        Subject::factory(10)->create();
        Allocation::factory(50)->create();
        AllocationDetail::factory(100)->create();
        Schedule::factory(100)->create();
        Forum::factory(50)->create();
        Assignment::factory(30)->create();
        Reply::factory(50)->create();


        DB::table('users')->insert([
            'name' => 'tintin',
            'email' => 'tintin@gmail.com',
            'password' => bcrypt('asd'),
            'role' => 'admin',
        ]);
    }
}
