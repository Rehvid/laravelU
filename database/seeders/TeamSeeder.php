<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::create([
            'name' => 'Frontend Developerzy',
            'user_id' => rand(1, 13),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Team::create([
            'name' => 'Backend Developerzy',
            'user_id' => rand(1, 13),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Team::create([
            'name' => 'Graficy',
            'user_id' => rand(1, 13),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Team::create([
            'name' => 'SEO',
            'user_id' => rand(1, 13),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Team::create([
            'name' => 'UX/UI Designerzy',
            'user_id' => rand(1, 13),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Team::create([
            'name' => 'Dział sprzedaży',
            'user_id' => rand(1, 13),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
