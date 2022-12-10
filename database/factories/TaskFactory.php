<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Task;
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
            'user_id' => rand(3, 13),
            'team_id' => rand(1, 10),
            'status_id' => rand(1, 16),
            'title' => $this->faker->name,
            'description' => $this->faker->sentence(),
            'deadline' => $this->faker->dateTimeBetween('now', '+2 week'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
