<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Task::create([
            'user_id' => rand(4, 13),
            'team_id' => rand(1, 10),
            'status_id' => '1',
            'title' => $faker->name,
            'description' => $faker->sentence(),
            'deadline' => $faker->dateTimeBetween('now', '+2 week'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Task::create([
            'user_id' => rand(4, 13),
            'team_id' => rand(1, 10),
            'status_id' => '2',
            'title' => $faker->name,
            'description' => $faker->sentence(),
            'deadline' => $faker->dateTimeBetween('now', '+1 week'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Task::create([
            'user_id' => rand(4, 13),
            'team_id' => rand(1, 10),
            'status_id' => '3',
            'title' => $faker->name,
            'description' => $faker->sentence(),
            'deadline' => $faker->dateTimeBetween('now', '+3 week'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Task::create([
            'user_id' => rand(4, 13),
            'team_id' => rand(1, 10),
            'status_id' => '4',
            'title' => $faker->name,
            'description' => $faker->sentence(),
            'deadline' => $faker->dateTimeBetween('now', '7 days'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Task::create([
            'user_id' => rand(4, 13),
            'team_id' => rand(1, 10),
            'status_id' => '5',
            'title' => $faker->name,
            'description' => $faker->sentence(),
            'deadline' => $faker->dateTimeBetween('now', '10 days'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Task::create([
            'user_id' => rand(4, 13),
            'team_id' => rand(1, 10),
            'status_id' => '6',
            'title' => $faker->name,
            'description' => $faker->sentence(),
            'deadline' => $faker->dateTimeBetween('now', '10 days'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
