<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{

    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $user_id = rand(1, 50),
            'team_id' => User::select('team_id')
                ->where('id', '=', $user_id)
                ->pluck('team_id')
                ->first(),
            'status_id' => rand(1, 50),
            'title' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'deadline' => $this->faker->dateTimeBetween('now', '+2 week'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
