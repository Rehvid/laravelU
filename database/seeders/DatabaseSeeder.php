<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Team;
use App\Models\User;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Database\Seeders\TeamSeeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(TeamSeeder::class);

        User::factory(50)->create();
        Status::factory(50)->create();
        Team::factory(50)->create();

        $this->call(TaskSeeder::class);
        Task::factory(50)->create();
    }
}
