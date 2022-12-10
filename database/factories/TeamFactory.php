<?php

namespace Database\Factories;

use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    protected $model = Team::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'user_id' => rand(1, 13),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => rand(0, 5) === 0
                ? $this->faker->dateTimeBetween("- 1 week", "+ 2 weeks")
                : null,
        ];
    }
}
