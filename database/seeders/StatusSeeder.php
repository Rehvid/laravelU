<?php

namespace Database\Seeders;

use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['name' => 'Aktywne', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        Status::create(['name' => 'W realizacji', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        Status::create(['name' => 'Wykonane', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        Status::create(['name' => 'Odłożone', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        Status::create(['name' => 'Do weryfikacji', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        Status::create(['name' => 'Oczekiwanie na kogoś', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
    }
}
