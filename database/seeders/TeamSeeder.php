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
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Team::create([
            'name' => 'Backend Developerzy',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Team::create([
            'name' => 'Graficy',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Team::create([
            'name' => 'SEO',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Team::create([
            'name' => 'UX/UI Designerzy',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Team::create([
            'name' => 'Dział sprzedaży',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
