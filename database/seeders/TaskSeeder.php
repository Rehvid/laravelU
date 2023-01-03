<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use Faker\Generator as Faker;
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
            'user_id' => $user_id = rand(1, 50),
            'team_id' => User::select('team_id')
                ->where('id', '=', $user_id)
                ->pluck('team_id')
                ->first(),

            'status_id' => '1',
            'title' => $faker->word(),
            'description' => $faker->paragraph(),
            'deadline' => $faker->dateTimeBetween('now', '+2 week'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Task::create([
            'user_id' => $user_id = rand(1, 50),
            'team_id' => User::select('team_id')
                ->where('id', '=', $user_id)
                ->pluck('team_id')
                ->first(),
            'status_id' => '2',
            'title' => $faker->word(),
            'description' => $faker->paragraph(),
            'deadline' => $faker->dateTimeBetween('now', '+1 week'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Task::create([
            'user_id' => $user_id = rand(1, 50),
            'team_id' => User::select('team_id')
                ->where('id', '=', $user_id)
                ->pluck('team_id')
                ->first(),
            'status_id' => '3',
            'title' => $faker->word(),
            'description' => $faker->paragraph(),
            'deadline' => $faker->dateTimeBetween('now', '+3 week'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Task::create([
            'user_id' => $user_id = rand(1, 50),
            'team_id' => User::select('team_id')
                ->where('id', '=', $user_id)
                ->pluck('team_id')
                ->first(),
            'status_id' => '4',
            'title' => $faker->word(),
            'description' => $faker->paragraph(),
            'deadline' => $faker->dateTimeBetween('now', '7 days'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Task::create([
            'user_id' => $user_id = rand(1, 50),
            'team_id' => User::select('team_id')
                ->where('id', '=', $user_id)
                ->pluck('team_id')
                ->first(),
            'status_id' => '5',
            'title' => $faker->word(),
            'description' => $faker->paragraph(),
            'deadline' => $faker->dateTimeBetween('now', '10 days'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Task::create([
            'user_id' => $user_id = rand(1, 50),
            'team_id' => User::select('team_id')
                ->where('id', '=', $user_id)
                ->pluck('team_id')
                ->first(),
            'status_id' => '6',
            'title' => $faker->word(),
            'description' => $faker->paragraph(),
            'deadline' => $faker->dateTimeBetween('now', '10 days'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
